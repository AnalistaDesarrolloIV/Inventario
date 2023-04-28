<?php

namespace App\Http\Controllers;

use App\Models\PedidoSap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FacturaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $pedidos = PedidoSap::all()->where('ESTADO_ID', 4);
        // dd($pedidos);
        return view('pages.operarios.factura.index', compact('pedidos'));
    }
    
    public function facturar(Request $request)
    {
        $peds = $request->all();
        // dd($peds);
        
        date_default_timezone_set('America/Bogota');
        // dd($peds['pedidos']);
        if (isset($peds['pedidos'])) {
            foreach ($peds['pedidos'] as $key => $value) {
                DB::beginTransaction();
                    $ped_estado = PedidoSap::where('PEDIDO', $value);
                    $ped2 = DB::select("SELECT EMPACADOR FROM PedidosSap WHERE PEDIDO = '". $value."'");
                    $ped2 = json_decode( json_encode( $ped2),true);
                    if ($ped2[0]['EMPACADOR'] != "") {
                        $ped_estado->update([
                            'ESTADO_ID' => 7,
                        ]);
                    }
                DB::commit();
                
            }

            Alert::success('Facturar', 'Se han facturado exitosamente todos los pedidos.');
            return redirect()->route('fac.index');
        }else {
            Alert::warning('Selección', 'Debes Seleccionar por lo menos un pedido a empacar.');
            return redirect()->route('emp.index');
        }
    }
}
