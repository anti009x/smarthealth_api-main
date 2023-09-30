<?php

namespace App\Http\Resources\Master\Ahli;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GetJadwalAntrianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id_jadwal_antrian" => $this->id_jadwal_antrian,
            "detail" => [
                "id_jadwal_praktek" => $this->jadwal_praktek->id_jadwal_praktek,
                "tanggal" => Carbon::createFromFormat('Y-m-d', $this->jadwal_praktek->tanggal)->isoFormat('D MMMM Y'),
                "mulai_jam" => $this->jadwal_praktek->mulai_jam,
                "selesai_jam" => $this->jadwal_praktek->selesai_jam
            ],
            "lokasi" => [
                "nama_rs" => $this->jadwal_praktek->detail_praktek->rumah_sakit->nama_rs,
                "alamat_rs" => $this->jadwal_praktek->detail_praktek->rumah_sakit->alamat_rs
            ],
            "nomor_str" => $this->jadwal_praktek->detail_praktek->user->getDokter->nomor_str,
            "ahli" => $this->jadwal_praktek->detail_praktek->user->nama,
            "status" => $this->status,
            "tanggal" => Carbon::createFromFormat('Y-m-d', $this->tanggal)->isoFormat('DD MMMM YYYY'),
            "code" => $this->qr_code
        ];
    }
}
