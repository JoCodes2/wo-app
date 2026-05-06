<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProfilWo;
use App\Repositories\LandingPageRepositories;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    use HttpResponseTraits;
    protected $landingRepo;

    public function __construct(LandingPageRepositories $landingRepo)
    {
        $this->landingRepo = $landingRepo;
    }

    public function index(Request $request)
    {
        return $this->landingRepo->getListWo($request);
    }

    public function show($id)
    {
        return $this->landingRepo->getDetailWo($id);
    }

    public function categories()
    {
        return $this->landingRepo->getCategories();
    }
    public function getWo()
    {
        return $this->landingRepo->getWo();
    }
    public function getTopWo()
    {
        try {
            $query = DB::table('profil_wo as wo')
                ->select(
                    'wo.id',
                    'wo.nama_wo',
                    'wo.alamat_wo',
                    'wo.foto_logo',
                    DB::raw('(SELECT AVG(u.rating) FROM ulasans u
                          JOIN pemesanans p ON u.pemesanan_id = p.id
                          JOIN layanans l ON p.layanan_id = l.id
                          WHERE l.wo_id = wo.id) as rating_rata_rata'),
                    DB::raw('COALESCE((SELECT MIN(harga) FROM layanans WHERE wo_id = wo.id), 0) as harga_min')
                )
                ->orderByDesc('rating_rata_rata')
                ->limit(4)
                ->get();

            return $this->success($query);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400);
        }
    }
}
