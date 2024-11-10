<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Modules\Users\Database\seeders\UserSeeder;
use App\Modules\Admins\Database\seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
        ]);
    }
}
