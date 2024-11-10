<?php

namespace App\Modules\Users\Policies;

use App\Modules\Users\Models\User;
use App\Modules\Admins\Models\Admin;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(Admin $admin)
    {
        return $admin->hasDirectPermission('user.view_any');
    }

    /**
     * Determine whether the Admin can view the model.
     */
    public function view(Admin $admin)
    {
        return $admin->hasDirectPermission('user.view');
    }

    /**
     * Determine whether the Admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasDirectPermission('user.create');
    }

    /**
     * Determine whether the Admin can update the model.
     */
    public function update(Admin $admin)
    {
        return $admin->hasDirectPermission('user.update');
    }

    /**
     * Determine whether the Admin can delete the model.
     */
    public function delete(Admin $admin)
    {
        //
        return $admin->hasDirectPermission('user.delete');
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user)
    {
        //
    }
}
