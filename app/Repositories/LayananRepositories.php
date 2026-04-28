<?php

namespace App\Repositories;

use App\Http\Requests\LayananRequest;
use App\Interfaces\KategorimediaInterfaces;
use App\Interfaces\LayananInterfaces;
use App\Models\Layanan;
use App\Models\MediaPartner;
use App\Models\MediaPartnerKategori;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LayananRepositories implements LayananInterfaces
{
    use HttpResponseTraits;
    protected $Layanan;
    public function __construct(Layanan $Layanan)
    {
        $this->Layanan = $Layanan;
    }

    public function getAllData()
    {
        $data = $this->Layanan->latest()->get();

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }

        return $this->success($data);
    }


    public function createData(LayananRequest $request)
    {
        try {
            $data = $this->Layanan->create($request->all());
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
        $data = $this->Layanan
            ->with(['wo', 'kategori'])
            ->find($id);

        if (!$data) {
            return $this->idOrDataNotFound();
        }

        return $this->success($data);
    }


    public function updateData($id, LayananRequest $request)
    {
        try {
            $data = $this->Layanan->find($id);
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
        $data = $this->Layanan->find($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }
        $data->delete();
        return $this->delete();
    }
}
