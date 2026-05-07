<?php

namespace App\Repositories;

use App\Http\Requests\GaleriRequest;
use App\Interfaces\GaleriInterfaces;
use App\Interfaces\GalerimediaInterfaces;
use App\Interfaces\LayananInterfaces;
use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\MediaPartner;
use App\Models\MediaPartnerGaleri;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GaleriRepositories implements GaleriInterfaces
{
    use HttpResponseTraits;
    protected $Galeri;
    public function __construct(Galeri $Galeri)
    {
        $this->Galeri = $Galeri;
    }

    public function getAllData()
    {
        $user = Auth::user();
        $profilWo = $user->profilWo;

        if (!$profilWo) {
            return $this->dataNotFound();
        }

        $data = $this->Galeri
            ->where('wo_id', $profilWo->id)
            ->latest()
            ->get();

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }

        return $this->success($data);
    }


    public function createData(GaleriRequest $request)
    {
        try {
            $user = Auth::user();
            $profilWo = $user->profilWo;

            if (!$profilWo) {
                return $this->error('Profil WO tidak ditemukan. Lengkapi profil bisnis terlebih dahulu.', 403);
            }

            $data = $request->all();
            $data['wo_id'] = $profilWo->id;

            if ($request->hasFile('foto_portofolio')) {
                $file = $request->file('foto_portofolio');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/galeri'), $filename);
                $data['foto_portofolio'] = 'uploads/galeri/' . $filename;
            }

            $result = $this->Galeri->create($data);
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

        $data = $this->Galeri::find($id);
        if (!$data) {
            return $this->dataNotFound();
        }

        // Pastikan data milik WO yang login
        if ($profilWo && $data->wo_id !== $profilWo->id) {
            return $this->error('Anda tidak memiliki akses ke data ini.', 403);
        }

        return $this->success($data);
    }


    public function deleteData($id)
    {
        $user = Auth::user();
        $profilWo = $user->profilWo;

        $data = $this->Galeri->find($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }

        // Pastikan data milik WO yang login
        if ($profilWo && $data->wo_id !== $profilWo->id) {
            return $this->error('Anda tidak memiliki akses untuk menghapus data ini.', 403);
        }

        // Hapus file dari storage jika ada
        if ($data->foto_portofolio && file_exists(public_path($data->foto_portofolio))) {
            unlink(public_path($data->foto_portofolio));
        }

        $data->delete();
        return $this->delete();
    }
}
