<?php

namespace App\Repositories;

use App\Interfaces\LandingPageInterfaces;
use App\Models\ProfilWo;
use App\Models\Kategori;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageRepositories implements LandingPageInterfaces
{
    use HttpResponseTraits;

    protected $profilWoModel;
    protected $kategoriModel;

    public function __construct(ProfilWo $profilWoModel, Kategori $kategoriModel)
    {
        $this->profilWoModel = $profilWoModel;
        $this->kategoriModel = $kategoriModel;
    }

    public function getListWo(Request $request)
    {
        try {
            $query = DB::table('profil_wo as wo')
                ->join('users as u_acc', 'wo.user_id', '=', 'u_acc.id')
                ->select(
                    'wo.id',
                    'wo.nama_wo',
                    'wo.alamat_wo',
                    'wo.foto_logo',
                    DB::raw('(SELECT AVG(u.rating) FROM ulasans u
                          JOIN pemesanans p ON u.pemesanan_id = p.id
                          JOIN layanans l ON p.layanan_id = l.id
                          WHERE l.wo_id = wo.id) as rating_rata_rata'),
                    DB::raw('(SELECT COUNT(u.id) FROM ulasans u
                          JOIN pemesanans p ON u.pemesanan_id = p.id
                          JOIN layanans l ON p.layanan_id = l.id
                          WHERE l.wo_id = wo.id) as total_vote'),
                    DB::raw('COALESCE((SELECT MIN(harga) FROM layanans WHERE wo_id = wo.id), 0) as harga_min'),
                    DB::raw('COALESCE((SELECT MAX(harga) FROM layanans WHERE wo_id = wo.id), 0) as harga_max')
                )
                ->where('u_acc.status_akun', 'aktif');

            if ($request->filled('search')) {
                $query->where('wo.nama_wo', 'like', '%' . trim($request->search) . '%');
            }

            if ($request->filled('min_price')) {
                $query->having('harga_min', '>=', $request->min_price);
            }
            if ($request->filled('max_price')) {
                $query->having('harga_max', '<=', $request->max_price);
            }

            if ($request->filled('sort')) {
                switch ($request->sort) {
                    case 'rating':
                        $query->orderByDesc('rating_rata_rata');
                        break;
                    case 'price_asc':
                        $query->orderBy('harga_min', 'asc');
                        break;
                    case 'price_desc':
                        $query->orderByDesc('harga_max');
                        break;
                }
            }

            $perPage = 6;
            $paginatedData = $query->paginate($perPage);

            return $this->formatPaginatedData($paginatedData);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400);
        }
    }

    private function formatPaginatedData($paginator)
    {
        if ($paginator->isEmpty()) return $this->dataNotFound();

        $mapped = collect($paginator->items())->map(function ($item) {
            $categories = DB::table('layanans as l')
                ->join('kategoris as k', 'l.kategori_id', '=', 'k.id')
                ->where('l.wo_id', $item->id)
                ->distinct()
                ->pluck('k.nama_kategori');

            return [
                'id' => $item->id,
                'nama_wo' => $item->nama_wo,
                'foto_logo' => $item->foto_logo,
                'alamat_wo' => $item->alamat_wo,
                'rating' => $item->rating_rata_rata ? round((float)$item->rating_rata_rata, 1) : 0,
                'total_vote' => (int)($item->total_vote ?? 0),
                'range_harga' => [
                    'min' => $item->harga_min ?? 0,
                    'max' => $item->harga_max ?? 0,
                ],
                'kategori' => $categories
            ];
        });

        return $this->success([
            'list' => $mapped,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
            ]
        ]);
    }

    public function getWo()
    {
        try {
            $data = DB::table('profil_wo as wo')
                ->join('users as u_acc', 'wo.user_id', '=', 'u_acc.id')
                ->select(
                    'wo.id',
                    'wo.nama_wo',
                    'wo.alamat_wo',
                    'wo.foto_logo',
                    DB::raw('(SELECT AVG(u.rating) FROM ulasans u
                              JOIN pemesanans p ON u.pemesanan_id = p.id
                              JOIN layanans l ON p.layanan_id = l.id
                              WHERE l.wo_id = wo.id) as rating_rata_rata'),
                    DB::raw('(SELECT COUNT(u.id) FROM ulasans u
                              JOIN pemesanans p ON u.pemesanan_id = p.id
                              JOIN layanans l ON p.layanan_id = l.id
                              WHERE l.wo_id = wo.id) as total_vote'),
                    DB::raw('(SELECT MIN(harga) FROM layanans WHERE wo_id = wo.id) as harga_min'),
                    DB::raw('(SELECT MAX(harga) FROM layanans WHERE wo_id = wo.id) as harga_max')
                )
                ->where('u_acc.status_akun', 'aktif')
                ->get();

            return $this->formatRawData($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400);
        }
    }

    private function formatRawData($collection)
    {
        if ($collection->isEmpty()) return $this->dataNotFound();

        $mapped = $collection->map(function ($item) {
            $categories = DB::table('layanans as l')
                ->join('kategoris as k', 'l.kategori_id', '=', 'k.id')
                ->where('l.wo_id', $item->id)
                ->distinct()
                ->pluck('k.nama_kategori');

            return [
                'id' => $item->id,
                'nama_wo' => $item->nama_wo,
                'foto_logo' => $item->foto_logo,
                'alamat_wo' => $item->alamat_wo,
                'rating' => $item->rating_rata_rata ? round((float)$item->rating_rata_rata, 1) : 0,
                'total_vote' => (int)($item->total_vote ?? 0),
                'range_harga' => [
                    'min' => $item->harga_min ?? 0,
                    'max' => $item->harga_max ?? 0,
                ],
                'kategori' => $categories
            ];
        });

        return $this->success($mapped);
    }

    public function getDetailWo($id)
    {
        try {
            $data = $this->profilWoModel::with([
                'galeris',
                'layanans.kategori',
                'layanans.pemesanans.ulasan.user'
            ])->find($id);

            if (!$data) return $this->idOrDataNotFound();

            $allUlasans = $data->layanans->flatMap(function ($layanan) {
                return $layanan->pemesanans->map(function ($pemesanan) {
                    return $pemesanan->ulasan;
                });
            })->filter()->values();
            $data->total_vote = $allUlasans->count();
            $data->rating_rata_rata = $allUlasans->count() > 0 ? $allUlasans->avg('rating') : 0;

            $data->ulasans = $allUlasans;

            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400);
        }
    }

    public function getCategories()
    {
        try {
            $data = $this->kategoriModel::all();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400);
        }
    }
}
