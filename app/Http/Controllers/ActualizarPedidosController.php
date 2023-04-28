<?php

namespace App\Http\Controllers;

use App\Models\DetallesPedido;
use App\Models\PedidoSap;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ActualizarPedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'ValidarRol']);
    }

    public function index()
    {
        return view('pages.administrador.pedidos.Index');
    } 
    
    public function store()
    {
        
        DB::beginTransaction();
            $response = Http::retry(30, 5, throw: false)->post('https://10.170.20.95:50000/b1s/v1/Login',[
                'CompanyDB' => 'INVERSIONES',
                'UserName' => 'Desarrollos',
                'Password' => 'Asdf1234$',
            ])['SessionId'];
            DB::delete('
                DELETE FROM DetallesPedido
            ');
            DB::delete('
                DELETE FROM PedidosSap
            ');
            $ped = Http::retry(30, 5, throw: false)->withToken($response)->get("https://10.170.20.95:50000/b1s/v1/sml.svc/ENTREGAS")['value'];
            // dd($ped);
            foreach ($ped as $key => $value) {
                if (DB::table('PedidosSap')->where('PEDIDO', $value['PEDIDO'])->doesntExist()) {
                    // dd($value['DOCUMENTO']);
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
                    foreach ($det as $key => $val) {
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
        Alert::success('Copia', 'Copiado Exitosamente.');
        return redirect()->route('act.index');
    }
}
