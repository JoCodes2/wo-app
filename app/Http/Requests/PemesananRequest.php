<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PemesananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'layanan_id'   => 'required|exists:layanans,id',
            'tgl_acara'    => 'required|date|after_or_equal:today',
            'lokasi_acara' => 'required|string',
            'catatan'      => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'layanan_id.required' => 'Paket layanan wajib dipilih.',
            'layanan_id.exists'   => 'Paket layanan tidak valid.',
            'tgl_acara.required'  => 'Tanggal acara wajib diisi.',
            'tgl_acara.after_or_equal' => 'Tanggal acara tidak boleh di masa lalu.',
            'lokasi_acara.required' => 'Lokasi acara wajib diisi.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'code'    => 422,
                'status'  => 'validation_failed',
                'message' => 'Periksa kembali inputan Anda',
                'data'    => $validator->errors(),
            ], 422)
        );
    }
}
