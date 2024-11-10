<?php

namespace App\Modules\Users\Models;

use Tur1\modules\Models\Authenticatable;
use App\Modules\Users\Filters\GenderFilter;
use App\Modules\Users\Filters\StatusFilter;
use App\Modules\Users\Observers\UserObserver;
use App\Modules\Users\Traits\UserScopesTrait;
use App\Modules\Users\Traits\UserAttributesTrait;
use App\Modules\Users\Traits\UserRelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory,
        UserScopesTrait,
        UserAttributesTrait,
        UserRelationshipsTrait;

    protected $guard_name = 'web';


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

    protected $search = ['email', 'name'];

    protected static function booted()
    {
        static::observe(UserObserver::class);
    }

    public static function filters()
    {
        return [
            GenderFilter::class,
            StatusFilter::class
        ];
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
