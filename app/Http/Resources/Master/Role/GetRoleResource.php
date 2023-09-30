<?php

namespace App\Http\Resources\Master\Role;

use App\Models\Master\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRoleResource extends JsonResource
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
            "id_role" => $this->id_role,
            "nama_role" => $this->nama_role
        ];
    }
}
