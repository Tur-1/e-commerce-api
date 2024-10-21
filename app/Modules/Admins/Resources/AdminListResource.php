<?php

namespace App\Modules\Admins\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminListResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'status' => $this->status,
            'created_at' => date_format($this->created_at, 'Y-m-d'),
        ];
    }
}
