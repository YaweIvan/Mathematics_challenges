<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrator;

class AdministratorSeeder extends Seeder
{
    public function run()
    {
        Administrator::updateOrCreate(
            ['adminUserName' => 'admin@mtcchallenge'],
            ['password' => 'admin_password'] // This will be hashed automatically
        );
    }
}
