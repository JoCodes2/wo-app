<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GaleriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wo_id'             => 'nullable|string',
            'foto_portofolio'   => 'required|file|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan'        => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'wo_id.string'                    => 'ID WO harus berupa teks.',

            'foto_portofolio.required'        => 'Foto portofolio wajib diunggah.',
            'foto_portofolio.file'            => 'File portofolio tidak valid.',
            'foto_portofolio.image'           => 'File harus berupa gambar.',
            'foto_portofolio.mimes'           => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto_portofolio.max'             => 'Ukuran gambar maksimal 2 MB.',

            'keterangan.required'             => 'Keterangan wajib diisi.',
            'keterangan.string'               => 'Keterangan harus berupa teks.',
            'keterangan.max'                  => 'Keterangan maksimal 500 karakter.',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'code'    => 422,
                'status'  => 'validation_failed',
                'message' => 'Check your input data',
                'data'    => $validator->errors(),
            ], 422)
        );
    }
}
