<?php

namespace App\Modules\Roles\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RolePermissionsResource extends JsonResource
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

        return $this->resource->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        })->map(function ($permissions) {
            return $permissions->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => explode('.', $permission->name)[1], // Extracts the part after the dot
                ];
            });
        });
    }
}
