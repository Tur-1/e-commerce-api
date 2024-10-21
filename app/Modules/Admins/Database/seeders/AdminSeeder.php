<?php
namespace App\Modules\Admins\Database\seeders;

use App\Modules\Admins\Models\Admin;
use Illuminate\Database\Seeder;
 
class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::factory(60)->create();
    }
}