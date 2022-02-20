<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmpresaSeeder extends Seeder
    {
        public function run()
        {
            $personal = new Empresa;
            $personal->razon = 'Perez Breakfast';
            $personal->rif = 'J-1234567890';
            $personal->tlf = '12345678900';
            $personal->email = 'breakfast@gmail.com';
            $personal->password = bcrypt('12345678');
            $personal->save();

        }
    }
