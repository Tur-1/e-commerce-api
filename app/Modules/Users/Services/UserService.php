<?php

namespace App\Modules\Users\Services;

use App\Modules\Users\Resources\UserListResource;
use App\Modules\Users\Resources\UserShowResource;
use App\Modules\Users\Exceptions\UserException;
use App\Modules\Users\Models\User;

class UserService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $users = $this->user->query()
            ->withFilters()
            ->latest('id')
            ->get();

        return UserListResource::collection($users);
    }

    public function getPaginatedList($perPage = 16)
    {
        $users = $this->user->query()
            ->withFilters()
            ->latest('id')
            ->paginate($perPage);

        return UserListResource::collection($users)
            ->response()
            ->getData(true);
    }

    public function createUser($validatedRequest)
    {
        return $this->user->create($validatedRequest);
    }

    public function getUser($id)
    {
        $user = $this->user::query()->find($id);

        if (!$user) {
            throw UserException::notFound();
        }
        return UserShowResource::make($user);
    }

    public function updateUser($validatedRequest, $id)
    {
        $user = $this->getUser($id);
        $user->update($validatedRequest);

        return UserShowResource::make($user);
    }

    public function deleteUser($id)
    {
        return $this->user->where('id', $id)->delete();
    }
}
