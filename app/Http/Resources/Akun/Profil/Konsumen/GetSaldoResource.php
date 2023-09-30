<?php

namespace App\Http\Resources\Akun\Profil\Konsumen;

use Illuminate\Http\Resources\Json\JsonResource;

class GetSaldoResource extends JsonResource
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
            "value_saldo" => $this->saldo,
            "saldo_akhir" => $this->saldo
        ];
    }
}
