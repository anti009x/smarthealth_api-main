<?php

namespace App\Http\Resources\Transaksi;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetResepObatResource extends JsonResource
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
            "id_resep_obat_detail" => $this->id_resep_obat_detail,
            "rekomendasi" => [
                "nama" => $this->resep_obat->users->nama,
                "nomor_hp" => $this->resep_obat->users->nomor_hp
            ],
            "produk" => [
                "kode" => $this->kode_produk,
                "nama" => $this->nama_produk,
                "slug" => $this->slug_produk,
                "deskripsi" => $this->deskripsi_produk,
                "harga" => "Rp." . number_format($this->harga_produk)
            ],
            "tanggal" => Carbon::createFromFormat("Y-m-d H:i:s", $this->resep_obat->tanggal)->isoFormat("dddd, DD MMMM YYYY | HH:mm:ss"),
            "jumlah_butuh" => $this->jumlah
        ];
    }
}
