<?php

namespace App\Http\Controllers;

use App\Jobs\empaque_sap;
use App\Models\DetallesPedido;
use App\Models\DetalleUnidadesEmpaque;
use App\Models\PedidoSap;
use App\Models\UnidadesEmpaque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EmpaqueController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $pedidos = PedidoSap::all()->where('ESTADO_ID', 3);
        // dd($pedidos);
        return view('pages.operarios.empaque.index', compact('pedidos'));
    }
    public function contar(Request $request)
    {
        $peds = $request->all();
        // dd($peds);
        
        date_default_timezone_set('America/Bogota');

        $horaActual = date("h:i:s"); 
        $uniond = "";
        $unionp = "";
        if (isset($peds['pedidos'])) {
            foreach ($peds['pedidos'] as $key => $value) {
                DB::beginTransaction();
                    $ped_estado = PedidoSap::where('PEDIDO', $value);
                    // dd($ped_estado);
                    $ped2 = DB::select("SELECT EMPACADOR FROM PedidosSap WHERE PEDIDO = '". $value."'");
                    // dd($ped2);
                    $ped2 = json_decode( json_encode( $ped2),true);
                    // dd($ped2);
                    if ($ped2[0]['EMPACADOR'] == "" || $ped2[0]['EMPACADOR'] == Auth::user()->nameSAP) {
                        $ped_estado->update([
                            'EMPACADOR' =>  Auth::user()->nameSAP,
                            'HORA_INICIO_EMP' => $horaActual,
                            'ESTADO_ID' => 4,
                        ]);
                        
                        $unionp = $unionp."SELECT * FROM PedidosSap WHERE PEDIDO = '". $value. "' union all ";

                        $det_ped = DetallesPedido::where('PEDIDO_ID', $value);
                        // dd($ped_estado);
                        // $det_ped->update([
                        //     'ESTADO_ID' => 2,
                        // ]);
        
                        $uniond = $uniond."SELECT * FROM DetallesPedido WHERE PEDIDO_ID = '". $value. "' union all ";
                    }
                DB::commit();
                
            }

            // dd($union);
            if ($unionp != "") {
                $consult = substr($unionp , 0, -10);
                $pedidos = DB::select($consult);
            }
            // dd($pedidos);
            if ($uniond != "") {
                $consulta = substr($uniond , 0, -10);
                $det_vista = DB::select($consulta);
                // dd($det_vista);
            $unidades = UnidadesEmpaque::all();
    
                return view('pages.operarios.empaque.form', compact('pedidos','det_vista', 'unidades'));
            }else {
                Alert::warning('Selección', 'Los pedidos seleccionados ya se encuentran en proseso de empaque.');
                return redirect()->route('emp.index');
            }
        }else {
            Alert::warning('Selección', 'Debes Seleccionar por lo menos un pedido a empacar.');
            return redirect()->route('emp.index');
        }
    }
    public function guardarLineas(Request $request)
    {
        date_default_timezone_set('America/Bogota');

        $horaActual = date("h:i:s"); 
        $inp = $request->all();
        // dd($inp);
        $pedidos = array_unique ($inp['pedidos']);
        $cons_ped = '';
        $unidades = $inp['uni_emp'];
        // dd($unidades);

        DB::beginTransaction();
            foreach ($pedidos as $key => $value) {
                $ped = PedidoSap::where('PEDIDO', $value);
                $ped->update([
                    'HORA_FIN_EMP' => $horaActual,
                    'ESTADO_ID' => 4,
                ]);
                $cons_ped = $cons_ped."-".$value;
            }

            foreach ($unidades as $num => $uni) {
                DetalleUnidadesEmpaque::create([
                    'REFERENCIAS' => $cons_ped,
                    'UNIDAD_ID' => $uni,
                    'CANTIDAD' => $inp['cant_unidades'][$num]
                ]);

            }
        DB::commit();

        empaque_sap::dispatch()->onQueue("Empaque");
        
        Alert::success('Recolección', 'Recolección finalizada correctamente.');
        return redirect()->route('rec.index');
    }
}
