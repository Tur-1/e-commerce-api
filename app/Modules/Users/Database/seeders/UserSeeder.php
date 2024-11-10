<?php
namespace App\Modules\Users\Database\seeders;

use App\Modules\Users\Database\factories\UserFactory;
use Illuminate\Database\Seeder;
 
class UserSeeder extends Seeder
{
    public function run()
    {
        UserFactory::new()->count(30)->create();
    }
}