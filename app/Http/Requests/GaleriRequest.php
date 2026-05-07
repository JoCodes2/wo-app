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
            'wo_id.string' => 'WO ID harus berupa string.',
            'wo_id.required' => 'WO ID wajib diisi.',
            'foto_portofolio.required' => 'Foto portofolio wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
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
