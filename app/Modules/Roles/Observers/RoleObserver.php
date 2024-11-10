<?php

namespace App\Modules\Roles\Observers;

use App\Modules\Roles\Models\Role;

class RoleObserver
{
    public function creating(Role $role)
    {
        $role->guard_name = 'admin';
    }
    public function updating(Role $role)
    {
        $role->guard_name = 'admin';
    }
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        //
    }
}
