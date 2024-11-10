<?php
namespace App\Modules\Roles\Database\factories;

use App\Modules\Roles\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [];
    }
}
