<?php

namespace App\Modules\Auth\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "gender" => $this->gender,
            "status" => $this->status,
        ];
    }
}
