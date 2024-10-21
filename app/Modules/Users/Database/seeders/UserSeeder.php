<?php

namespace App\Modules\Users\Database\seeders;

use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(60)->create();
    }
}
