<?php

namespace App\Repositories;

use App\Interfaces\PemesananInterfaces;
use App\Http\Requests\PemesananRequest;
use App\Models\Layanan;
use App\Models\Pemesanan;
use App\Models\Ulasan;
use App\Traits\HttpResponseTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Override;

class PemesananRepositories implements PemesananInterfaces
{
    use HttpResponseTraits;

    protected $pemesanan;

    public function __construct(Pemesanan $pemesanan)
    {
        $this->pemesanan = $pemesanan;
    }

    public function getAllData()
    {
        $user = Auth::user();
        $query = $this->pemesanan->with(['user', 'layanan.wo', 'ulasan']);

        if ($user->role === 'user') {
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'wo') {
            $profilWo = $user->profilWo;

            if (!$profilWo) {
                return $this->dataNotFound();
            }
            $query->whereHas('layanan', function ($q) use ($profilWo) {
                $q->where('wo_id', $profilWo->id);
            });
        }


        $data = $query->latest()->get();

        return $data->isEmpty() ? $this->dataNotFound() : $this->success($data);
    }

    public function createData(PemesananRequest $request)
    {
        try {
            $data = $request->all();
            $data['id'] = Str::uuid();
            $data['user_id'] = Auth::id();
            $data['status_pesanan'] = 'menunggu';

            $result = $this->pemesanan->create($data);
            return $this->success($result);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }

    public function getDataById($id)
    {
        $data = $this->pemesanan->with(['user', 'layanan.wo', 'layanan.kategori'])->find($id);

        if (!$data) return $this->dataNotFound();

        $user = Auth::user();
        if ($user->role === 'user' && $data->user_id !== $user->id) {
            return $this->error("Unauthorized access to invoice", 403);
        }

        return $this->success($data);
    }
    public function getLayananById($id)
    {
        $data = Layanan::with(['wo', 'kategori'])->find($id);

        if (!$data) {
            return $this->dataNotFound();
        }

        return $this->success($data);
    }
    public function createUlasan($request)
    {
        try {
            $pemesanan = $this->pemesanan->find($request->pemesanan_id);

            if (!$pemesanan) return $this->idOrDataNotFound();

            if ($pemesanan->user_id !== Auth::id()) {
                return $this->error("Akses ditolak", 403);
            }

            if ($pemesanan->status_pesanan !== 'selesai') {
                return $this->error("Ulasan hanya dapat diberikan jika status pesanan sudah selesai", 400);
            }

            $exists = Ulasan::where('pemesanan_id', $request->pemesanan_id)->exists();
            if ($exists) {
                return $this->error("Anda sudah memberikan ulasan untuk pesanan ini", 400);
            }

            $result = Ulasan::create([
                'id' => Str::uuid(),
                'pemesanan_id' => $request->pemesanan_id,
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'komentar' => $request->komentar,
            ]);

            return $this->success($result, "Terima kasih atas ulasan Anda");
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }

    public function konfirmasiPesanan($id, $status)
    {
        try {
            $data = $this->pemesanan->find($id);
            if (!$data) return $this->idOrDataNotFound();

            if (Auth::user()->role !== 'wo' && Auth::user()->role !== 'admin') {
                return $this->error("Hanya vendor yang dapat melakukan konfirmasi", 403);
            }

            $data->update(['status_pesanan' => $status]);
            return $this->success($data, "Status pesanan berhasil diperbarui ke: $status");
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
}
