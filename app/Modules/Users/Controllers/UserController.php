<?php

namespace App\Modules\Users\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Modules\Users\Services\UserService;
use App\Modules\Admins\Enums\AdminGenderEnum;
use App\Modules\Admins\Enums\AdminStatusEnum;
use App\Modules\Users\Models\User;
use App\Modules\Users\Requests\StoreUserRequest;
use App\Modules\Users\Requests\UpdateUserRequest;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll(Request $request)
    {

        Gate::authorize('viewAny', User::class);

        $users = $this->userService->getAll();

        return response()->json([
            'users' => $users,
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

        Gate::authorize('viewAny', User::class);

        $users = $this->userService->getPaginatedList();

        return $users;
    }

    public function store(StoreUserRequest $request)
    {
        Gate::authorize('create', User::class);

        $validatedRequest = $request->validated();

        $this->userService->createUser($validatedRequest);

        return response()->json([
            'message' => 'user has been created successfully',
        ]);
    }

    public function show($id)
    {

        Gate::authorize('view', User::class);

        $user = $this->userService->getUser($id);

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        Gate::authorize('update', User::class);

        $validatedRequest = $request->validated();

        $user = $this->userService->updateUser($validatedRequest, $id);

        return response()->json([
            'message' => 'user has been updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy($id)
    {
        Gate::authorize('delete', User::class);

        $this->userService->deleteUser($id);

        return response()->json([
            'message' => 'user has been deleted successfully',
        ]);
    }
}
