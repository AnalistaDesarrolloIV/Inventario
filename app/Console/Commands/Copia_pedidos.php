<?php

namespace App\Console\Commands;

use App\Models\DetallesPedido;
use App\Models\PedidoSap;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Copia_pedidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Copia_pedidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
          
        DB::beginTransaction();
            $response = Http::retry(30, 5, throw: false)->post('https://10.170.20.95:50000/b1s/v1/Login',[
                'CompanyDB' => 'ZPRUREBANO',
                'UserName' => 'Desarrollos',
                'Password' => 'Asdf1234$',
            ])['SessionId'];
            // dd($response);
            $ped = Http::retry(30, 5, throw: false)->withToken($response)->get("https://10.170.20.95:50000/b1s/v1/sml.svc/ENTREGAS")['value'];
            // dd($ped->all()['value']);
            foreach ($ped as $key => $value) {
                // dd($value['COD_CLIENTE']);
                if (DB::table('PedidosSap')->where('PEDIDO', $value['PEDIDO'])->doesntExist()) {
                    PedidoSap::create([
                        'COD_CLIENTE' => $value['COD_CLIENTE'],
                        'NOMBRE_CLIENTE' => $value['NOMBRE_CLIENTE'],
                        'PEDIDO' => $value['PEDIDO'],
                        'DOCUMENTO' => $value['DOCUMENTO'],
                        'CANT_LINEAS' => $value['CANT_LINEAS'],
                        'CANT_UNIDADES' => $value['CANT_UNIDADES'],
                        'FECHA' => $value['FECHA'],
                        'COMENTARIOS' => $value['COMENTARIOS'],
                        'ESTADO_ID' => 1
                    ]); 
                    $det = DB::select("SELECT * FROM DETALLE_PED WHERE PEDIDO = '". $value['PEDIDO']."'");
                    // dd($det);
                    foreach ($det as $key => $val) {
                        // dd($val->FECHA_OPERACION);
                        DetallesPedido::create([
                            'PEDIDO_ID'=> $val->PEDIDO,
                            'CODIGO_ARTICULO' => $val->CODIGO_ARTICULO,
                            'DESCRIPCION_ARTICULO' => $val->DESCRIPCION_ARTICULO,
                            'LOTE' => $val->LOTE,
                            'CANTIDAD' => $val->CANTIDAD,
                            'ESTADO' => $val->ESTADO,
                            'OPERADOR_QUE_EJECUTA' => $val->OPERADOR_QUE_EJECUTA,
                            'NOMBRE_BAHIA' => $val->NOMBRE_BAHIA,
                            'NOMBRE_PASILLO' => $val->NOMBRE_PASILLO,
                            'UBICACION' => $val->UBICACION,
                            'COMPARTIMENTO' => $val->COMPARTIMENTO,
                            'CODIGO_BARRAS' => $val->CODIGO_BARRAS,
                            'ESTADO_ID' => 1
                        ]);
                    }
                }
            }

        DB::commit();
    }
}
