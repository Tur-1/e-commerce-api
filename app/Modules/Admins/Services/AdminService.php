<?php

namespace App\Modules\Admins\Services;

use App\Modules\Admins\Resources\AdminListResource;
use App\Modules\Admins\Resources\AdminShowResource;
use App\Modules\Admins\Exceptions\AdminException;
use App\Modules\Admins\Models\Admin;
use App\Modules\Roles\Models\Role;
use App\Modules\Roles\Services\RoleService;

class AdminService
{
    private Admin $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function getAll()
    {
        $admins = $this->admin->query()
            ->withFilters()
            ->latest('id')
            ->get();

        return AdminListResource::collection($admins);
    }

    public function getRoleswithPermissions()
    {
        return (new RoleService(new Role()))->getAll();
    }
    public function getPaginatedList($perPage = 16)
    {
        $admins = $this->admin->query()
            ->withFilters()
            ->latest('id')
            ->paginate($perPage);

        return AdminListResource::collection($admins)
            ->response()
            ->getData(true);
    }

    public function createAdmin($validatedRequest)
    {
        $admin = $this->admin->create($validatedRequest);

        $admin->syncRoles($validatedRequest['role_id']);
        $admin->syncPermissions($validatedRequest['permissions']);
    }

    public function getAdmin($id)
    {
        $admin = $this->admin::query()->with('roles.permissions')->find($id);

        if (!$admin) {
            throw AdminException::notFound();
        }
        return AdminShowResource::make($admin);
    }

    public function updateAdmin($validatedRequest, $id)
    {
        $admin = $this->admin::query()->find($id);
        $admin->update($validatedRequest);
        $admin->syncRoles($validatedRequest['role_id']);
        $admin->syncPermissions($validatedRequest['permissions']);

        return AdminShowResource::make($admin);
    }

    public function deleteAdmin($id)
    {
        return $this->admin->where('id', $id)->delete();
    }
}
