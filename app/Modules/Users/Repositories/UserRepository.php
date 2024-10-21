<?php

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\User;

class UserRepository
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getAll()
    {
        return $this->user->get();
    }
    public function getPaginatedList($records = 16)
    {
        return $this->user->latest('id')->simplePaginate($records);
    }
    public function createUser($validatedRequest)
    {
        return $this->user->create($validatedRequest);
    }
    public function getUser($id)
    {
        $this->user = $this->user->query()->findOrFail($id);

        return $this->user;
    }
    public function updateUser($validatedRequest, $id)
    {
        $user = $this->getUser($id);
        $user->update($validatedRequest);
        return  $user;
    }
    public function deleteUser($id)
    {
        return $this->user->where('id', $id)->delete();
    }
}
