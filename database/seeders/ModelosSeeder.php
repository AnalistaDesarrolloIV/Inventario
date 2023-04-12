<?php

namespace Database\Seeders;

use App\Models\ModelosRecuento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelosRecuento::create([
            'Model' => 'Ciego',
        ]);
        ModelosRecuento::create([
            'Model' => 'Guiado',
        ]);
        ModelosRecuento::create([
            'Model' => 'Semiguiado',
        ]);
    }
}
