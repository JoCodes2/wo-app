<?php

namespace App\Repositories;

use App\Http\Requests\KategoriRequest;
use App\Interfaces\KategoriInterfaces;
use App\Interfaces\KategorimediaInterfaces;
use App\Interfaces\LayananInterfaces;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\MediaPartner;
use App\Models\MediaPartnerKategori;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KategoriRepositories implements KategoriInterfaces
{
    use HttpResponseTraits;
    protected $Kategori;
    public function __construct(Kategori $Kategori)
    {
        $this->Kategori = $Kategori;
    }

    public function getAllData()
    {
        $data = $this->Kategori->latest()->get();

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }

        return $this->success($data);
    }


    public function createData(KategoriRequest $request)
    {
        try {
            $data = $this->Kategori->create($request->all());
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error(
                $th->getMessage(),
                400,
                $th,
                class_basename($this),
                __FUNCTION__
            );
        }
    }
    public function getDataById($id)
    {
        $data = $this->Kategori
            ->with(['layanans'])
            ->find($id);

        if (!$data) {
            return $this->idOrDataNotFound();
        }

        return $this->success($data);
    }


    public function updateData($id, KategoriRequest $request)
    {
        try {
            $data = $this->Kategori->find($id);
            if (!$data) {
                return $this->idOrDataNotFound();
            }
            $data->update($request->all());
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error(
                $th->getMessage(),
                400,
                $th,
                class_basename($this),
                __FUNCTION__
            );
        }
    }
    public function deleteData($id)
    {
        $data = $this->Kategori->find($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }
        $data->delete();
        return $this->delete();
    }
}
