<?php

namespace App\Modules\Roles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tur1\modules\Models\Model;
use App\Modules\Roles\Observers\RoleObserver;
use App\Modules\Roles\Traits\RoleScopesTrait;
use App\Modules\Roles\Traits\RoleRelationshipsTrait;
use App\Modules\Roles\Traits\RoleAttributesTrait;
use App\Modules\Roles\Database\factories\RoleFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use Tur1\modules\Models\BaseModelTrait;

class Role extends SpatieRole
{

    use HasFactory,
        RoleScopesTrait,
        RoleAttributesTrait,
        RoleRelationshipsTrait,
        BaseModelTrait;

    protected $fillable = ['name', 'guard_name'];

    protected $search = ['name'];

    protected static function booted()
    {
        static::observe(RoleObserver::class);
    }

    public static function filters()
    {
        return [];
    }
}
