<?php

namespace App\Modules\Admins\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Tur1\modules\Models\Authenticatable;
use App\Modules\Admins\Filters\GenderFilter;
use App\Modules\admins\Filters\StatusFilter;
use App\Modules\Admins\Observers\AdminObserver;
use App\Modules\Admins\Traits\AdminScopesTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Modules\Admins\Traits\AdminAttributesTrait;
use App\Modules\Admins\Traits\AdminRelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Admins\Database\factories\AdminFactory;

class Admin extends Authenticatable
{
    use HasFactory,
        Notifiable,
        AdminScopesTrait,
        AdminAttributesTrait,
        AdminRelationshipsTrait,
        HasRoles,
        HasApiTokens;

    protected $guard_name = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'status'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $search = ['name'];

    protected static function booted()
    {
        static::observe(AdminObserver::class);
    }

    public static function filters()
    {
        return [
            GenderFilter::class,
            StatusFilter::class
        ];
    }

    protected function getDefaultGuardName(): string
    {
        return 'admin';
    }

    /**
     * Interact with the admin's password.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::needsRehash($value) ? Hash::make($value) : $value,
        );
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
