<?php

namespace App\Modules\Admins\Policies;

use Illuminate\Auth\Access\Response;
use App\Modules\Admins\Models\Admin;

class AdminPolicy
{
    /**
     * Determine whether the Admin can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasDirectPermission('admin.view_any');
    }

    /**
     * Determine whether the Admin can view the model.
     */
    public function view(Admin $admin)
    {
        return $admin->hasDirectPermission('admin.view');
    }

    /**
     * Determine whether the Admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasDirectPermission('admin.create');
    }

    /**
     * Determine whether the Admin can update the model.
     */
    public function update(Admin $admin)
    {
        return $admin->hasDirectPermission('admin.update');
    }

    /**
     * Determine whether the Admin can delete the model.
     */
    public function delete(Admin $admin)
    {
        //
        return $admin->hasDirectPermission('admin.delete');
    }

    /**
     * Determine whether the Admin can restore the model.
     */
    public function restore(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the Admin can permanently delete the model.
     */
    public function forceDelete(Admin $admin)
    {
        //
    }
}
