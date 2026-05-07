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
        $user = Auth::user();
        $profilWo = $user->profilWo;

        if (!$profilWo) {
            return $this->dataNotFound();
        }

        $data = $this->Layanan
            ->where('wo_id', $profilWo->id)
            ->latest()
            ->get();

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }

        return $this->success($data);
    }


    public function createData(LayananRequest $request)
    {
        try {
            $user = Auth::user();
            $profilWo = $user->profilWo;

            if (!$profilWo) {
                return $this->error('Profil WO tidak ditemukan. Lengkapi profil bisnis terlebih dahulu.', 403);
            }

            $data = array_merge($request->all(), [
                'wo_id' => $profilWo->id,
            ]);

            $result = $this->Layanan->create($data);
            return $this->success($result);
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
        $user = Auth::user();
        $profilWo = $user->profilWo;

        $data = $this->Layanan
            ->with(['wo', 'kategori'])
            ->find($id);

        if (!$data) {
            return $this->idOrDataNotFound();
        }

        // Pastikan data milik WO yang login
        if ($profilWo && $data->wo_id !== $profilWo->id) {
            return $this->error('Anda tidak memiliki akses ke data ini.', 403);
        }

        return $this->success($data);
    }


    public function updateData($id, LayananRequest $request)
    {
        try {
            $user = Auth::user();
            $profilWo = $user->profilWo;

            $data = $this->Layanan->find($id);
            if (!$data) {
                return $this->idOrDataNotFound();
            }

            // Pastikan data milik WO yang login
            if ($profilWo && $data->wo_id !== $profilWo->id) {
                return $this->error('Anda tidak memiliki akses untuk mengubah data ini.', 403);
            }

            $data->update($request->except('wo_id'));
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
        $user = Auth::user();
        $profilWo = $user->profilWo;

        $data = $this->Layanan->find($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }

        // Pastikan data milik WO yang login
        if ($profilWo && $data->wo_id !== $profilWo->id) {
            return $this->error('Anda tidak memiliki akses untuk menghapus data ini.', 403);
        }

        $data->delete();
        return $this->delete();
    }
}
