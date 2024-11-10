<?php

namespace App\Modules\Roles\Policies;

use App\Modules\Roles\Models\Role;
use App\Modules\Admins\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasDirectPermission('role.view_any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin)
    {
        return $admin->hasDirectPermission('role.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasDirectPermission('role.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin)
    {
        return $admin->hasDirectPermission('role.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin)
    {
        return $admin->hasDirectPermission('role.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin)
    {
        //
    }
}
