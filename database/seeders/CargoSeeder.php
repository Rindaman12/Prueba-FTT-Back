<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CargoSeeder extends Seeder
    {
        public function run()
        {
            $cargo = new Cargo;
            $cargo->cargo = 'Full-Stack Developer';
            $cargo->save();

        }
    }
