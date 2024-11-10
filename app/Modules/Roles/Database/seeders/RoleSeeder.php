<?php
namespace App\Modules\Roles\Database\seeders;

use App\Modules\Roles\Database\factories\RoleFactory;
use Illuminate\Database\Seeder;
 
class RoleSeeder extends Seeder
{
    public function run()
    {
        RoleFactory::new()->count(30)->create();
    }
}