<?php

namespace App\Http\Requests\Apotek\ProfilApotek;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ValidatorProfilApotek extends FormRequest
{
    public function rules(Request $request)
    {
        return [
            "nama" => "required",
            "password" => "required|min:8|max:15",
            "nomor_hp" => "required|min:12",
            "jenis_kelamin" => "required",
            // "foto" => "required",
            "nama_apotek" => "required",
            "deskripsi_apotek" => "required",
            "alamat_apotek" => "required",
            "nomor_hp_apotek" => "required",
            "foto_apotek" => "required",
            "latitude" => "required",
            "longitude" => "required",
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
