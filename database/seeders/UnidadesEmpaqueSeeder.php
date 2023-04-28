<?php

namespace Database\Seeders;

use App\Models\UnidadesEmpaque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadesEmpaqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnidadesEmpaque::create([
            'NOMBRE' => 'Caja Generica',
        ]);
        UnidadesEmpaque::create([
            'NOMBRE' => 'Bolsa',
        ]);
        UnidadesEmpaque::create([
            'NOMBRE' => 'Nevera',
        ]);
    }
}
