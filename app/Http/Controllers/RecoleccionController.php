<?php

namespace App\Http\Controllers;

use App\Jobs\recoleccion_sap;
use App\Models\DetallesPedido;
use App\Models\PedidoSap;
use DateTimeZone;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RecoleccionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $pedidos = PedidoSap::all()->where('ESTADO_ID', '<>', 3);
        // dd($pedidos);

        return view('pages.operarios.recoleccion.index', compact('pedidos'));
    }

    public function contar(Request $request)
    {
        $peds = $request->all();
        // dd($peds);
        
        date_default_timezone_set('America/Bogota');

        $horaActual = date("h:i:s"); 
        $union = "";
        if (isset($peds['pedidos'])) {
            foreach ($peds['pedidos'] as $key => $value) {
                DB::beginTransaction();
                    $ped_estado = PedidoSap::where('PEDIDO', $value);
                    // dd($ped_estado);
                    $ped2 = DB::select("SELECT RECOLECTOR FROM PedidosSap WHERE PEDIDO = '". $value."'");
                    // dd($ped2);
                    $ped2 = json_decode( json_encode( $ped2),true);
                    // dd($ped2);
                    if ($ped2[0]['RECOLECTOR'] == "" || $ped2[0]['RECOLECTOR'] == Auth::user()->nameSAP) {
                        $ped_estado->update([
                            'RECOLECTOR' =>  Auth::user()->nameSAP,
                            'HORA_INICIO_REC' => $horaActual,
                            'ESTADO_ID' => 2,
                        ]);
                        $det_ped = DetallesPedido::where('PEDIDO_ID', $value);
                        // dd($ped_estado);
                        $det_ped->update([
                            'ESTADO_ID' => 2,
                        ]);
        
                        $union = $union."SELECT * FROM DetallesPedido WHERE PEDIDO_ID = '". $value. "' AND ESTADO_ID <> 5 union all ";
                    }
                DB::commit();
                
            }

            // dd($union);
            if ($union != "") {
                $consulta = substr($union , 0, -10);
                $det_vista = DB::select($consulta);
                // dd($det_vista);
    
                return view('pages.operarios.recoleccion.conteo', compact('det_vista'));
            }else {
                Alert::warning('Selección', 'Los pedidos seleccionados ya se encuentran en proseso de recolección.');
                return redirect()->route('rec.index');
            }
        }else {
            Alert::warning('Selección', 'Debes Seleccionar por lo menos un pedido a recoger.');
            return redirect()->route('rec.index');
        }
    }

    public function guardarLineas(Request $request)
    {
        date_default_timezone_set('America/Bogota');

        $horaActual = date("h:i:s"); 
        $inp = $request->all();
        // dd($inp);
        $pedidos = array_unique ($inp['pedido_lista']);
        DB::beginTransaction();
            foreach ($pedidos as $key => $value) {
                $ped = PedidoSap::where('PEDIDO', $value);
                $ped->update([
                    'HORA_FIN_REC' => $horaActual,
                    'ESTADO_ID' => 3,
                ]);
            }
            foreach($inp['productos_listos'] AS $key => $val){
                // dd($val);
                $det = DetallesPedido::find($val);
                // dd($det);
                $det->update([
                    'ESTADO_ID' => 5,
                ]);
            };
        DB::commit();

        recoleccion_sap::dispatch()->onQueue("Recoleccion");
        
        Alert::success('Recolección', 'Recolección finalizada correctamente.');
        return redirect()->route('rec.index');
    }
}
