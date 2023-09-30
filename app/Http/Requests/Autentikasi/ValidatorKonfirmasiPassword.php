<?php

namespace App\Http\Requests\Autentikasi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ValidatorKonfirmasiPassword extends FormRequest
{
    public function rules()
    {
        return [
            "password" => "required|min:8|max:15",
            "confirm_password" => "required|min:8|max:15"
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
