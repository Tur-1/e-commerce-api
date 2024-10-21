<?php

namespace App\Modules\Admins\Database\factories;

use Illuminate\Support\Str;
use App\Modules\Admins\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Modules\Admins\Enums\AdminGenderEnum;
use App\Modules\Admins\Enums\AdminStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'password' =>  Hash::make(123456),
            'gender' => fake()->randomElement([AdminGenderEnum::Female, AdminGenderEnum::Male]),
            'status' => fake()->randomElement([AdminStatusEnum::INACTIVE, AdminStatusEnum::ACTIVE]),
        ];
    }
}
