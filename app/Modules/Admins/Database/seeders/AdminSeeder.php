<?php

namespace App\Modules\Admins\Database\seeders;

use App\Modules\Admins\Database\factories\AdminFactory;
use App\Modules\Admins\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        AdminFactory::new()->count(10)->create();
    }
}
