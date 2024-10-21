<?php

namespace App\Modules\Admins\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tur1\Laravelmodules\Models\BaseModel;
use App\Modules\Admins\Observers\AdminObserver;
use App\Modules\Admins\Traits\AdminScopesTrait;
use App\Modules\Admins\Traits\AdminRelationshipsTrait;
use App\Modules\Admins\Traits\AdminAttributesTrait;
use App\Modules\Admins\Database\factories\AdminFactory;
use App\Modules\Admins\Filters\GenderFilter;
use App\Modules\admins\Filters\StatusFilter;
use Illuminate\Notifications\Notifiable;
use Tur1\Laravelmodules\Models\AuthenticatableBaseModel;

class Admin extends AuthenticatableBaseModel
{
    use HasFactory,
        Notifiable,
        AdminScopesTrait,
        AdminAttributesTrait,
        AdminRelationshipsTrait;

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

    protected $search = [];

    protected static function booted()
    {
        // parent::booted();
        static::observe(AdminObserver::class);
    }

    public static function filters()
    {
        return [
            GenderFilter::class,
            StatusFilter::class
        ];
    }
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AdminFactory::new();
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
