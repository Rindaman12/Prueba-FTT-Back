<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
    {
        public function run()
        {
            $admin = new User;
            $admin->nombre = 'luis';
            $admin->email = 'luispena@gmail.com';
            $admin->password = bcrypt('12345678');
            $admin->remember_token = Str::random(10);
            $admin->save();

        }
    }
