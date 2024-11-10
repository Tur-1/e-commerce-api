<?php

namespace App\Modules\Roles\Services;

use App\Modules\Roles\Resources\RoleListResource;
use App\Modules\Roles\Resources\RoleShowResource;
use App\Modules\Roles\Exceptions\RoleException;
use App\Modules\Roles\Models\Role;
use App\Modules\Roles\Resources\RolePermissionsResource;
use Spatie\Permission\Models\Permission;

class RoleService
{
    private Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {
        $roles = $this->role->query()
            ->withFilters()
            ->latest('id')
            ->get();


        return RoleListResource::collection($roles);
    }



    public function allPermissions()
    {
        return new RolePermissionsResource(Permission::all());
    }
    public function getPaginatedList($perPage = 16)
    {
        $roles = $this->role->query()
            ->withFilters()
            ->latest('id')
            ->paginate($perPage);

        return RoleListResource::collection($roles)
            ->response()
            ->getData(true);
    }

    public function createRole($validatedRequest)
    {
        $role = $this->role->create($validatedRequest);

        $role->syncPermissions($validatedRequest['permissions']);
    }

    public function getRole($id)
    {
        $this->role = $this->role::query()->with('permissions')->find($id);

        if (!$this->role) {
            throw RoleException::notFound();
        }
        return RoleShowResource::make($this->role);
    }

    public function updateRole($validatedRequest, $id)
    {
        $role = $this->getRole($id);
        $role->update($validatedRequest);
        $role->syncPermissions($validatedRequest['permissions']);

        return RoleShowResource::make($role);
    }

    public function deleteRole($id)
    {
        return $this->role->where('id', $id)->delete();
    }
}
