<?php

namespace App\Http\Requests\Autentikasi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class ValidatorRegister extends FormRequest
{
    public function rules(Request $request)
    {
        if (($request->option == "dokter") || ($request->option == "perawat") || ($request->option == "apotek") ) {
            return [
                "nama" => "required",
                "email" => "email|unique:users",
                "password" => "required|min:8|max:15",
                "nomor_hp" => "required|unique:users",
                "option" => "required",
                "jenis_kelamin" => "required",
                "foto" => "required|image|mimes:png,jpg,jpeg|max:2048",
                "file_dokumen" => "required|mimetypes:application/pdf|max:10000",
            ];
        } else if ($request->option == "rumah_sakit") {
            return [
                "nama" => "required",
                "email" => "email|unique:users",
                "password" => "required|min:8|max:15",
                "nomor_hp" => "required|unique:users",
                "option" => "required",
                "jenis_kelamin" => "required",
                "foto" => "required|image|mimes:png,jpg,jpeg|max:2048",
                "file_dokumen" => "required|mimetypes:application/pdf|max:10000",
                "no_ktp" => "required|integer|digits_between:6,20"
            ];
        }
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
