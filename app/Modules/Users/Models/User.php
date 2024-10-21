<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tur1\Laravelmodules\Models\BaseModel;
use App\Modules\Users\Observers\UserObserver;
use App\Modules\Users\Traits\UserScopesTrait;
use App\Modules\Users\Traits\UserRelationshipsTrait;
use App\Modules\Users\Traits\UserAttributesTrait;
use App\Modules\Users\Database\factories\UserFactory;
use Illuminate\Notifications\Notifiable;
use Tur1\Laravelmodules\Models\AuthenticatableBaseModel;

class User extends AuthenticatableBaseModel
{
    use HasFactory,
        Notifiable,
        UserScopesTrait,
        UserAttributesTrait,
        UserRelationshipsTrait;


    protected $fillable = [
        'name',
        'email',
        'password',
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
        parent::booted();
        static::observe(UserObserver::class);
    }

    public static function filters()
    {
        return [];
    }
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
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
