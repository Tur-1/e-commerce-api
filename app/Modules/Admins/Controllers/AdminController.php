<?php

namespace App\Modules\Admins\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admins\Models\Admin;
use App\Modules\Admins\Enums\AdminGenderEnum;
use App\Modules\Admins\Enums\AdminStatusEnum;
use App\Modules\Admins\Services\AdminService;
use App\Modules\Admins\Requests\StoreAdminRequest;
use App\Modules\Admins\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getAll(Request $request)
    {
        Gate::authorize('viewAny', Admin::class);

        $admins = $this->adminService->getAll();

        return response()->json([
            'admins' => $admins,
        ]);
    }

    public function getGenders()
    {
        return response()->json([
            'genders' => AdminGenderEnum::cases()
        ]);
    }
    public function getStatus()
    {
        return response()->json([
            'status' => AdminStatusEnum::cases(),
        ]);
    }
    public function getPaginatedList(Request $request)
    {
        Gate::authorize('viewAny', Admin::class);

        $admins = $this->adminService->getPaginatedList();

        return $admins;
    }

    public function getRoleswithPermissions()
    {

        $roles = $this->adminService->getRoleswithPermissions();

        return response()->json([
            'roles' => $roles
        ]);
    }
    public function store(StoreAdminRequest $request)
    {
        Gate::authorize('create', Admin::class);

        $validatedRequest = $request->validated();

        $this->adminService->createAdmin($validatedRequest);

        return response()->json([
            'message' => 'admin has been created successfully',
        ]);
    }

    public function show($id)
    {
        // Gate::authorize('view', Admin::class);

        $admin = $this->adminService->getAdmin($id);

        return response()->json([
            'admin' => $admin,
        ]);
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        Gate::authorize('update', Admin::class);

        $validatedRequest = $request->validated();

        $admin = $this->adminService->updateAdmin($validatedRequest, $id);

        return response()->json([
            'message' => 'admin has been updated successfully',
            'admin' => $admin,
        ]);
    }

    public function destroy($id)
    {
        Gate::authorize('delete', Admin::class);

        $this->adminService->deleteAdmin($id);

        return response()->json([
            'message' => 'admin has been deleted successfully',
        ]);
    }
}
