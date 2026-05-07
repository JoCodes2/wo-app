<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Pemesanan;
use App\Models\ProfilWo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Statistik untuk Admin
     */
    public function adminStats()
    {
        $totalWo        = User::where('role', 'wo')->count();
        $totalUser      = User::where('role', 'user')->count();
        $woPending      = User::where('role', 'wo')->where('status_akun', 'pending')->count();
        $woAktif        = User::where('role', 'wo')->where('status_akun', 'aktif')->count();
        $totalKategori  = Kategori::count();
        $totalLayanan   = Layanan::count();
        $totalPemesanan = Pemesanan::count();

        // WO terbaru (5 terakhir)
        $woTerbaru = User::with('profilWo')
            ->where('role', 'wo')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($u) => [
                'id'           => $u->id,
                'nama_lengkap' => $u->nama_lengkap,
                'email'        => $u->email,
                'status_akun'  => $u->status_akun,
                'nama_wo'      => $u->profilWo?->nama_wo ?? '-',
                'foto_logo'    => $u->profilWo?->foto_logo,
                'created_at'   => $u->created_at?->format('d M Y'),
            ]);

        // Pemesanan per bulan (6 bulan terakhir)
        $pemesananPerBulan = Pemesanan::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
            DB::raw("COUNT(*) as total")
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Distribusi status pemesanan
        $statusPemesanan = Pemesanan::select('status_pesanan', DB::raw('COUNT(*) as total'))
            ->groupBy('status_pesanan')
            ->get();

        // WO pending yang perlu aktivasi
        $woPendingList = User::with('profilWo')
            ->where('role', 'wo')
            ->where('status_akun', 'pending')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($u) => [
                'id'           => $u->id,
                'nama_lengkap' => $u->nama_lengkap,
                'email'        => $u->email,
                'nama_wo'      => $u->profilWo?->nama_wo ?? '-',
                'created_at'   => $u->created_at?->format('d M Y'),
            ]);

        return response()->json([
            'code'    => 200,
            'message' => 'success',
            'data'    => [
                'stats' => [
                    'total_wo'        => $totalWo,
                    'total_user'      => $totalUser,
                    'wo_pending'      => $woPending,
                    'wo_aktif'        => $woAktif,
                    'total_kategori'  => $totalKategori,
                    'total_layanan'   => $totalLayanan,
                    'total_pemesanan' => $totalPemesanan,
                ],
                'wo_terbaru'          => $woTerbaru,
                'pemesanan_per_bulan' => $pemesananPerBulan,
                'status_pemesanan'    => $statusPemesanan,
                'wo_pending_list'     => $woPendingList,
            ],
        ]);
    }

    /**
     * Statistik untuk WO yang login
     */
    public function woStats()
    {
        $user     = Auth::user();
        $profilWo = $user->profilWo;

        if (!$profilWo) {
            return response()->json([
                'code'    => 200,
                'message' => 'success',
                'data'    => [
                    'stats'              => [],
                    'pemesanan_terbaru'  => [],
                    'pemesanan_per_bulan'=> [],
                    'status_pemesanan'   => [],
                    'layanan_terpopuler' => [],
                ],
            ]);
        }

        $woId = $profilWo->id;

        // Statistik dasar WO ini
        $totalLayanan   = Layanan::where('wo_id', $woId)->count();
        $totalGaleri    = Galeri::where('wo_id', $woId)->count();

        // Pemesanan via layanan yang dimiliki WO ini
        $layananIds     = Layanan::where('wo_id', $woId)->pluck('id');
        $totalPemesanan = Pemesanan::whereIn('layanan_id', $layananIds)->count();
        $pemesananBaru  = Pemesanan::whereIn('layanan_id', $layananIds)
            ->where('status_pesanan', 'pending')
            ->count();
        $pemesananSelesai = Pemesanan::whereIn('layanan_id', $layananIds)
            ->where('status_pesanan', 'selesai')
            ->count();

        // Estimasi revenue dari pemesanan yang selesai
        $estimasiRevenue = Pemesanan::whereIn('layanan_id', $layananIds)
            ->where('status_pesanan', 'selesai')
            ->join('layanans', 'pemesanans.layanan_id', '=', 'layanans.id')
            ->sum('layanans.harga');

        // Pemesanan terbaru (5)
        $pemesananTerbaru = Pemesanan::with(['user', 'layanan'])
            ->whereIn('layanan_id', $layananIds)
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($p) => [
                'id'             => $p->id,
                'nama_user'      => $p->user?->nama_lengkap ?? '-',
                'nama_layanan'   => $p->layanan?->nama_layanan ?? '-',
                'harga'          => $p->layanan?->harga ?? 0,
                'tgl_acara'      => $p->tgl_acara,
                'lokasi_acara'   => $p->lokasi_acara,
                'status_pesanan' => $p->status_pesanan,
                'created_at'     => $p->created_at?->format('d M Y'),
            ]);

        // Pemesanan per bulan (6 bulan terakhir)
        $pemesananPerBulan = Pemesanan::whereIn('layanan_id', $layananIds)
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw("COUNT(*) as total")
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Layanan terpopuler
        $layananTerpopuler = Layanan::where('wo_id', $woId)
            ->withCount('pemesanans')
            ->orderByDesc('pemesanans_count')
            ->take(5)
            ->get()
            ->map(fn($l) => [
                'nama_layanan'     => $l->nama_layanan,
                'harga'            => $l->harga,
                'pemesanans_count' => $l->pemesanans_count,
            ]);

        // Distribusi status pemesanan WO ini
        $statusPemesanan = Pemesanan::whereIn('layanan_id', $layananIds)
            ->select('status_pesanan', DB::raw('COUNT(*) as total'))
            ->groupBy('status_pesanan')
            ->get();

        return response()->json([
            'code'    => 200,
            'message' => 'success',
            'data'    => [
                'stats' => [
                    'total_layanan'    => $totalLayanan,
                    'total_galeri'     => $totalGaleri,
                    'total_pemesanan'  => $totalPemesanan,
                    'pemesanan_baru'   => $pemesananBaru,
                    'pemesanan_selesai'=> $pemesananSelesai,
                    'estimasi_revenue' => $estimasiRevenue,
                ],
                'pemesanan_terbaru'   => $pemesananTerbaru,
                'pemesanan_per_bulan' => $pemesananPerBulan,
                'layanan_terpopuler'  => $layananTerpopuler,
                'status_pemesanan'    => $statusPemesanan,
                'profil_wo' => [
                    'nama_wo'    => $profilWo->nama_wo,
                    'foto_logo'  => $profilWo->foto_logo,
                    'alamat_wo'  => $profilWo->alamat_wo,
                    'kontak'     => $profilWo->kontak,
                ],
            ],
        ]);
    }
}
