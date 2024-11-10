<?php

namespace App\Modules\Users\Database\factories;

use Illuminate\Support\Str;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Modules\Admins\Enums\AdminGenderEnum;
use App\Modules\Admins\Enums\AdminStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

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
