<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wo_id'         => 'nullable|string',
            'kategori_id'   => 'required',
            'nama_layanan'  => 'required|string|max:255',
            'harga'         => 'required|numeric|min:0',
            'detail_layanan'=> 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'kategori_id.required'  => 'Kategori wajib dipilih.',
            'nama_layanan.required' => 'Nama layanan wajib diisi.',
            'nama_layanan.max'      => 'Nama layanan maksimal 255 karakter.',
            'harga.required'        => 'Harga wajib diisi.',
            'harga.numeric'         => 'Harga harus berupa angka.',
            'harga.min'             => 'Harga tidak boleh kurang dari 0.',
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
