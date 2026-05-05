<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id');
        $isUpdate = $userId !== null;

        return [
            'nama_lengkap' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                $isUpdate ? Rule::unique('users', 'email')->ignore($userId) : 'unique:users,email',
            ],
            'no_hp' => 'required|string|max:20',
            'password' => $isUpdate
                ? 'nullable|string|min:8'
                : 'required|string|min:8',
            'role' => ['required', Rule::in(['admin', 'wo', 'user'])],

            // Tambahkan nullable sebelum string
            'nama_wo'           => 'required_if:role,wo|nullable|string|max:255',
            'biodata_pengelola' => 'required_if:role,wo|nullable|string',
            'alamat_wo'         => 'required_if:role,wo|nullable|string',
            'deskripsi_wo'      => 'required_if:role,wo|nullable|string',
            'kontak'            => 'required_if:role,wo|nullable|string|max:20',
            'foto_logo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sosial_media'      => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.unique'          => 'Email sudah terdaftar.',
            'role.required'         => 'Role wajib dipilih.',

            'nama_wo.required_if'           => 'Nama WO wajib diisi jika mendaftar sebagai Wedding Organizer.',
            'biodata_pengelola.required_if' => 'Biodata pengelola wajib diisi untuk profil WO.',
            'alamat_wo.required_if'         => 'Alamat WO wajib diisi.',
            'deskripsi_wo.required_if'      => 'Deskripsi layanan WO wajib diisi.',
            'kontak.required_if'            => 'Kontak WO wajib diisi.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'code'    => 422,
                'status'  => 'validation_failed',
                'message' => 'Terdapat kesalahan pada input data Anda.',
                'data'    => $validator->errors(),
            ], 422)
        );
    }
}
