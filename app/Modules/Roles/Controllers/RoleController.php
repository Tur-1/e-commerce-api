<?php

namespace App\Modules\Roles\Controllers;

use Illuminate\Http\Request;
use App\Modules\Roles\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Modules\Roles\Services\RoleService;
use App\Modules\Roles\Requests\StoreRoleRequest;
use App\Modules\Roles\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getAll(Request $request)
    {

        $roles = $this->roleService->getAll();

        return response()->json([
            'roles' => $roles,
        ]);
    }

    public function getPaginatedList(Request $request)
    {

        Gate::authorize('viewAny', Role::class);

        $roles = $this->roleService->getPaginatedList();

        return $roles;
    }

    public function allPermissions()
    {
        $allPermissions = $this->roleService->allPermissions();

        return response()->json(['allPermissions' => $allPermissions]);
    }
    public function store(StoreRoleRequest $request)
    {

        Gate::authorize('create', Role::class);

        $validatedRequest = $request->validated();

        $this->roleService->createRole($validatedRequest);

        return response()->json([
            'message' => 'role has been created successfully',
        ]);
    }

    public function show(Request $request, $id)
    {

        Gate::authorize('view', Role::class);

        $role = $this->roleService->getRole($id);
        $allPermissions = $this->roleService->allPermissions();


        return response()->json([
            'role' => $role,
            'allPermissions' => $allPermissions,
        ]);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        Gate::authorize('update', Role::class);

        $validatedRequest = $request->validated();

        $role = $this->roleService->updateRole($validatedRequest, $id);

        return response()->json([
            'message' => 'role has been updated successfully',
            'role' => $role,
        ]);
    }

    public function destroy($id)
    {
        Gate::authorize('delete', Role::class);

        $this->roleService->deleteRole($id);

        return response()->json([
            'message' => 'role has been deleted successfully',
        ]);
    }
}
