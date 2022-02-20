<?php

namespace Database\Seeders;

use App\Models\Personal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PersonalSeeder extends Seeder
    {
        public function run()
        {
            $personal = new Personal;
            $personal->nombre = 'Perez Almarza';
            $personal->email = 'luispena234@gmail.com';
            $personal->tlf = '12345678900';
            $personal->descripcion = 'Programador';
            $personal->cargo_id = 1;
            $personal->anos = 5;
            $personal->save();

        }
    }
