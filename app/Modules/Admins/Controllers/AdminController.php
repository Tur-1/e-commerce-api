<?php

namespace App\Modules\Admins\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admins\Enums\AdminGenderEnum;
use App\Modules\Admins\Enums\AdminStatusEnum;
use Illuminate\Http\Request;
use App\Modules\Admins\Requests\StoreAdminRequest;
use App\Modules\Admins\Requests\UpdateAdminRequest;
use App\Modules\Admins\Services\AdminService;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getAll(Request $request)
    {

        $admins = $this->adminService->getAll();

        return response()->json([
            'admins' => $admins,
        ]);
    }

    public function getGenders()
    {
        return response()->json([
            'genders' => [
                [
                    'name' => 'Female',
                    'value' => 'female'
                ],
                [
                    'name' => 'Male',
                    'value' => 'male'
                ],

            ],
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

        $admins = $this->adminService->getPaginatedList();

        return $admins;
    }

    public function store(StoreAdminRequest $request)
    {

        $validatedRequest = $request->validated();

        $this->adminService->create($validatedRequest);

        return response()->json([
            'message' => 'admin has been created successfully',
        ]);
    }

    public function show($id)
    {

        $admin = $this->adminService->show($id);

        return response()->json([
            'admin' => $admin,
        ]);
    }

    public function update(UpdateAdminRequest $request, $id)
    {

        $validatedRequest = $request->validated();


        $admin = $this->adminService->update($validatedRequest, $id);

        return response()->json([
            'message' => 'admin has been updated successfully',
            'admin' => $admin,
        ]);
    }

    public function destroy($id)
    {

        $this->adminService->delete($id);

        return response()->json([
            'message' => 'admin has been deleted successfully',
        ]);
    }
}
