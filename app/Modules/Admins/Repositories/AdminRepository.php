<?php

namespace App\Modules\Admins\Repositories;

use App\Modules\Admins\Models\Admin;

class AdminRepository
{
    private Admin $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
    public function getAll()
    {
        return $this->admin->get();
    }
    public function getPaginatedList($records = 16)
    {
        return $this->admin->query()->latest('id')->simplePaginate($records);
    }
    public function createAdmin($validatedRequest)
    {
        return $this->admin->create($validatedRequest);
    }
    public function getAdmin($id)
    {
        $this->admin = $this->admin::withoutGlobalScopes()->findOrFail($id);

        return $this->admin;
    }
    public function updateAdmin($validatedRequest, $id)
    {
        $admin = $this->getAdmin($id);
        $admin->update($validatedRequest);
        return  $admin;
    }
    public function deleteAdmin($id)
    {
        return $this->admin->where('id', $id)->delete();
    }
}
