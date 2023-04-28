<?php

namespace Database\Seeders;

use App\Models\EstadosPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosPedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadosPedido::create([
            'Nombre' => 'Pendiente',
        ]);
        
        EstadosPedido::create([
            'Nombre' => 'En Ejecución',
        ]);
        
        EstadosPedido::create([
            'Nombre' => 'Recogido',
        ]);
        
        EstadosPedido::create([
            'Nombre' => 'Empacado',
        ]);

        EstadosPedido::create([
            'Nombre' => 'Completo',
        ]);

        EstadosPedido::create([
            'Nombre' => 'Incompleto',
        ]);
        
        EstadosPedido::create([
            'Nombre' => 'Facturado',
        ]);
    }
}
