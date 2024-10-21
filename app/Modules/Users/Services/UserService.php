<?php

namespace App\Modules\Users\Services;

use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Resources\UserListResource;
use App\Modules\Users\Resources\UserShowResource;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return UserListResource::collection($this->userRepository->getAll());
    }
    public function getPaginatedList($records = 15)
    {
        return UserListResource::collection($this->userRepository->getPaginatedList($records))
        ->response()
        ->getData(true);
    }

    public function create($validatedRequest)
    {
        return $this->userRepository->createUser($validatedRequest);
    }

    public function show($id)
    {
        return UserShowResource::make($this->userRepository->getUser($id));
    }

    public function update($validatedRequest, $id)
    {
        $user = $this->userRepository->updateUser($validatedRequest, $id);

        return UserShowResource::make($user);
    }

    public function delete($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
