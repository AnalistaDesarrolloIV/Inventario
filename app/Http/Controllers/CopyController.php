<?php

namespace App\Http\Controllers;

use App\Models\Conteos;
use App\Models\CopiaWMS;
use App\Models\ModelosRecuento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;
use RealRashid\SweetAlert\Facades\Alert;

class CopyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'ValidarRol']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $fecha_hora = new DateTime("now", new DateTimeZone('America/Bogota'));
        
        $mytable = CopiaWMS::all()->where('DateCopy', $fecha_hora->format('Y-m-d'));
        $TableCopy = json_decode( json_encode($mytable),true);
        
        $usuarios = User::all();
        $usuarios = json_decode( json_encode( $usuarios),true);

        $TipoConteo = ModelosRecuento::all();
        $TipoConteo = json_decode( json_encode( $TipoConteo),true);
        // dd($TableCopy);
        
        return view('pages.administrador.stractWMS.GenCopy', compact('TableCopy', 'usuarios', 'TipoConteo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $viewCons = DB::table('INVENTARIO')->select('*')->get();
        $tableView = json_decode( json_encode($viewCons),true);
        
        $fecha_hora = new DateTime("now", new DateTimeZone('America/Bogota'));
        
        $exist = CopiaWMS::all()->where('DateCopy', $fecha_hora->format('Y-m-d'));
        $exist = json_decode( json_encode($exist),true);
        // dd($tableView);
        if($exist == []) {
            foreach($tableView as $tabla) {
                // $insert = CopiaWMS::create([
                //     'ItemCode' => $tabla['Articulo'],
                //     'Description'=> $tabla['Descripcion'],
                //     'BarCode'=> $tabla['CODIGO_BARRAS'],
                //     'Amount'=> $tabla['Cantidad'],
                //     'Lote'=> $tabla['Lote'],
                //     'DateExpiration'=> $tabla['Fecha_Vencimiento'],
                //     'Zone'=> $tabla['Almacen'],
                //     'Hallway'=> $tabla['Nombre_Pasillo'],
                //     'Location'=> $tabla['Ubicación'],
                //     'Compartment'=> $tabla['UDC'],
                //     'DateCopy' => $fecha_hora->format('Y-m-d H:i'),
                // ]);
                if ($tabla['Ubicación'] !== '') {
                    $ubi = $tabla['Ubicación'];
                }else {
                    $ubi = $tabla['Nombre_Pasillo']."-".$tabla['UDC'];
                }
                
                DB::table('CopiaWMS')->insert([
                    'ItemCode' => $tabla['Articulo'],
                    'Description'=> $tabla['Descripcion'],
                    'BarCode'=> $tabla['CODIGO_BARRAS'],
                    'Amount'=> $tabla['Cantidad'],
                    'Lote'=> $tabla['Lote'],
                    'DateExpiration'=> $tabla['Fecha_Vencimiento'],
                    'Zone'=> $tabla['Almacen'],
                    'Hallway'=> $tabla['Nombre_Pasillo'],
                    'Location'=> $ubi,
                    'Compartment'=> $tabla['UDC'],
                    'New' => 'no',
                    'DateCopy' => $fecha_hora->format('Y-m-d'),
                    'HourCopy' => $fecha_hora->format('H:i:s'),
                    'State' => 0,
                    "Type" => $tabla['Tipo_Articulo'],
                ]);
            }
            Alert::success('Copia', 'Copiado Exitosamente.');
            return redirect()->route('copia.index');  
        }else {
            Alert::warning('Copia', 'Solo es permitido realizar una copia por día');
            return redirect()->route('copia.index');  
        }
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
