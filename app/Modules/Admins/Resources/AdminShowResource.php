<?php

namespace App\Modules\Admins\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminShowResource extends JsonResource
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
        $role = $this->roles->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'role_id' => $role?->id,
            'permissions' => $this->permissions->pluck('id'),
            'status' => $this->status,
            'created_at' => date_format($this->created_at, 'Y-m-d'),
        ];
    }
}
