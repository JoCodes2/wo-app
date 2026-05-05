<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterfaces;
use App\Models\User;
use App\Models\ProfilWo;
use App\Traits\HttpResponseTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepositories implements UserInterfaces
{
    use HttpResponseTraits;

    protected $userModel;
    protected $profilWoModel;

    public function __construct(User $userModel, ProfilWo $profilWoModel)
    {
        $this->userModel = $userModel;
        $this->profilWoModel = $profilWoModel;
    }

    public function getAllData()
    {
        $data = $this->userModel::with('profilWo')->get();
        return $data->isEmpty() ? $this->dataNotFound() : $this->success($data);
    }

    public function createData(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new $this->userModel;
            $user->username = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->email = $request->input('email');
            $user->no_hp = $request->input('no_hp');
            $user->role = $request->input('role');
            $user->status_akun = $request->input('role') === 'wo' ? 'pending' : 'aktif';
            $user->save();

            if ($request->input('role') === 'wo') {
                $wo = new $this->profilWoModel;
                $wo->user_id = $user->id;
                $wo->nama_wo = $request->input('nama_wo');
                $wo->biodata_pengelola = $request->input('biodata_pengelola');
                $wo->alamat_wo = $request->input('alamat_wo');
                $wo->deskripsi_wo = $request->input('deskripsi_wo');
                $wo->kontak = $request->input('kontak');
                $wo->sosial_media = $request->input('sosial_media');

                if ($request->hasFile('foto_logo')) {
                    $file = $request->file('foto_logo');
                    $filename = 'logo-' . Str::random(15) . '.' . $file->getClientOriginalExtension();

                    if (!file_exists(public_path('uploads/logo'))) {
                        mkdir(public_path('uploads/logo'), 0755, true);
                    }

                    $file->move(public_path('uploads/logo'), $filename);
                    $wo->foto_logo = $filename;
                }
                $wo->save();
            }

            DB::commit();
            return $this->success($user->load('profilWo'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }

    public function getDataById($id)
    {
        $data = $this->userModel::with('profilWo')->find($id);
        if (!$data) return $this->idOrDataNotFound();
        return $this->success($data);
    }

    public function updateData($id, UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->userModel::find($id);
            if (!$user) return $this->idOrDataNotFound();

            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->email = $request->input('email');
            $user->no_hp = $request->input('no_hp');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            if ($user->role === 'wo') {
                $wo = $this->profilWoModel::where('user_id', $user->id)->first();
                if ($wo) {
                    $wo->nama_wo = $request->input('nama_wo');
                    $wo->biodata_pengelola = $request->input('biodata_pengelola');
                    $wo->alamat_wo = $request->input('alamat_wo');
                    $wo->deskripsi_wo = $request->input('deskripsi_wo');
                    $wo->kontak = $request->input('kontak');
                    $wo->sosial_media = $request->input('sosial_media');

                    if ($request->hasFile('foto_logo')) {
                        if ($wo->foto_logo && file_exists(public_path('uploads/logo/' . $wo->foto_logo))) {
                            unlink(public_path('uploads/logo/' . $wo->foto_logo));
                        }

                        $file = $request->file('foto_logo');
                        $filename = 'logo-' . Str::random(15) . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/logo'), $filename);
                        $wo->foto_logo = $filename;
                    }
                    $wo->save();
                }
            }

            DB::commit();
            return $this->success($user->load('profilWo'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }

    public function deleteData($id)
    {
        try {
            $user = $this->userModel::find($id);
            if (!$user) return $this->idOrDataNotFound();

            if ($user->role === 'wo') {
                $wo = $this->profilWoModel::where('user_id', $user->id)->first();
                if ($wo && $wo->foto_logo && file_exists(public_path('uploads/logo/' . $wo->foto_logo))) {
                    unlink(public_path('uploads/logo/' . $wo->foto_logo));
                }
            }

            $user->delete();
            return $this->success(null, "Data deleted successfully");
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }

    public function aktivasiAkunWo($id)
    {
        try {
            $user = $this->userModel::where('id', $id)->where('role', 'wo')->first();
            if (!$user) return $this->idOrDataNotFound();

            $user->status_akun = 'aktif';
            $user->save();

            return $this->success($user, "Account activated successfully");
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
}
