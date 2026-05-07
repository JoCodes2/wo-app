<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemesananRequest;
use App\Repositories\PemesananRepositories;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    protected $pemesananRepo;

    public function __construct(PemesananRepositories $pemesananRepo)
    {
        $this->pemesananRepo = $pemesananRepo;
    }

    public function getAllData()
    {
        return $this->pemesananRepo->getAllData();
    }

    public function createData(PemesananRequest $request)
    {
        return $this->pemesananRepo->createData($request);
    }

    public function getDataById($id)
    {
        return $this->pemesananRepo->getDataById($id);
    }

    public function konfirmasiPesanan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai,menunggu'
        ]);

        return $this->pemesananRepo->konfirmasiPesanan($id, $request->status);
    }
    public function getLayananById($id)
    {
        return $this->pemesananRepo->getLayananById($id);
    }
}
