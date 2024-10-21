<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Users\Requests\StoreUserRequest;
use App\Modules\Users\Requests\UpdateUserRequest;
use App\Modules\Users\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll(Request $request)
    {
   
       $users = $this->userService->getAll();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function getPaginatedList(Request $request)
    {
   
       $users = $this->userService->getPaginatedList();

        return $users;
    }
 
    public function store(StoreUserRequest $request)
    {

        $validatedRequest = $request->validated();

        $this->userService->create($validatedRequest);

        return response()->json([
            'message' => 'user has been created successfully',
        ]);
    }

    public function show($id)
    {
       
        $user = $this->userService->show($id);

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
      
        $validatedRequest = $request->validated();

        $user = $this->userService->update($validatedRequest, $id);

        return response()->json([
            'message' => 'user has been updated successfully',
           'user' => $user,
        ]);
    }

    public function destroy($id)
    { 

        $this->userService->delete($id);

        return response()->json([
            'message' => 'user has been deleted successfully',
        ]);
    }
}
