<?php

namespace App\Http\Requests\Master\Konsumen;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ValidatorKonsumen extends FormRequest
{
    public function rules(Request $request)
    {
        return [
            "nama" => "required",
            "password" => "required|min:8|max:15",
            "nomor_hp" => "required|min:12",
            "nik" => "required"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => "Maaf, Terjadi Kesalahan Dalam Permintaan Request",
            "data" => $validator->errors()
        ]));
    }
}
