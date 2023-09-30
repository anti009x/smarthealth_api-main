<?php

namespace App\Http\Resources\Midtrans;

use Illuminate\Http\Resources\Json\JsonResource;

class GetBankResource extends JsonResource
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
            "id_bank" => $this->id_bank,
            "nama_bank" => $this->nama_bank,
            "slug_bank" => $this->slug_bank,
            "logo" => $this->logo
        ];  
    }
}
