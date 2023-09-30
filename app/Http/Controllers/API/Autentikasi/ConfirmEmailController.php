<?php

namespace App\Http\Controllers\API\Autentikasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Autentikasi\ValidatorKonfirmasiPassword;
use App\Models\Akun\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ConfirmEmailController extends Controller
{
    public function confirm(Request $request)
    {
        try {
            $user = User::where("email", $request->email)->first();

            if (empty($user)) {
                return response()->json(["status" => false, "pesan" => "Email Tidak Terdaftar", "data" => []]);
            }

            $last_id = $user->id;

            $token = $last_id . hash('sha256', Str::random(120));

            ResetPassword::create([
                "id_reset_password" => "RS-P-".date("YmdHis"),
                "user_id" => $user->id,
                "token" => $token,
                "status" => "0"
            ]);

            $verifyUrl = "https://smarthealth.berobatplus.shop/reset_password/" . $token . "/verify";

            $pesan = "Selamat Datang <b>". $user->nama ."</b><br> di <a href='https://smarthealth.berobatplus.shop/'> Berobat Plus </a>";
            $pesan .= "<hr>";
            $pesan .= "Silahkan Klik Tombol Dibawah Ini Jika Anda Ingin Mengganti Password <br>";
            $pesan .= "Terima Kasih...";
            $mail_data = [
                'recipient' => $user['email'],
                'fromEmail' => $user['email'],
                'fromName' => $user['nama'],
                'subject' => 'Ganti Password Anda',
                'body' => $pesan,
                'actionLink' => $verifyUrl
            ];

            Mail::send('confirm_email', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
            });
    
            if ($user) {
                return response()->json(["pesan" => "Berhasil"]);
            } else {
                return response()->json(["pesan" => "Gagal"]);
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function forgot_password(ValidatorKonfirmasiPassword $request, $token)
    {
        try {
            $reset = ResetPassword::where("token", $token)->first();

            if ($reset->status == "1") {
                return response()->json(["status" => false, "pesan" => "Token Sudah Digunakan"]);
            }

            if ($request->password != $request->confirm_password) {
                return response()->json(["status" => false, "pesan" => "Konfirmasi Password Tidak Sesuai"]);
            }

            User::where("id", $reset->user_id)->update([
                "password" => bcrypt($request->password)
            ]);

            $reset->update([
                "status" => "1"
            ]);

            return response()->json(["status" => true, "pesan" => "Password Berhasil di Simpan"]);

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
