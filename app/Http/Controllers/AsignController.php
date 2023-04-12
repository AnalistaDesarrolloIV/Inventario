<?php

namespace App\Http\Controllers;

use App\Models\Conteos;
use App\Models\CopiaWMS;
use App\Models\DetalleConteos1;
use App\Models\DetalleConteos2;
use App\Models\DetalleConteos3;
use App\Models\ModelosRecuento;
use App\Models\Roles;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AsignController extends Controller
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
        
        $mytable = Conteos::all()->where('DateAsign', $fecha_hora->format('Y-m-d'));
        $mytable = json_decode( json_encode($mytable),true);
        
        $usuarios = User::all();
        $usuarios = json_decode( json_encode( $usuarios),true);

        $TipoConteo = ModelosRecuento::all();
        $TipoConteo = json_decode( json_encode( $TipoConteo),true);

        return view('pages.administrador.stractWMS.List', compact('mytable', 'usuarios', 'TipoConteo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fecha_hora = new DateTime("now", new DateTimeZone('America/Bogota'));

        $data = CopiaWMS::all();
        $data = json_decode( json_encode($data),true);
        
        $usuarios = User::all();
        $usuarios = json_decode( json_encode( $usuarios),true);

        $TipoConteo = ModelosRecuento::all();
        $TipoConteo = json_decode( json_encode( $TipoConteo),true);

        return view('pages.administrador.stractWMS.FormAsign', compact('data', 'usuarios', 'TipoConteo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $fecha_hora = new DateTime("now", new DateTimeZone('America/Bogota'));
        
        DB::beginTransaction();
            $conteo = Conteos::create([
                'Model_id' => $input["modelo_conteo"],
                "DateAsign" => $fecha_hora->format('Y-m-d'),
                "User1" => $input['user1'],
                "User2" => $input['user2'],
                // "User3" => $input['user3'],
                'State1'=>  0,
                'State2'=>  0,
                'State3'=>  0,
            ]);
            $conteo = json_decode(json_encode($conteo),true);

            if (isset($input["Zona"])) {
                foreach($input["Zona"] as $key => $value){
                    $copi = CopiaWMS::all()->where('Zone', $value)->where('DateCopy', $fecha_hora->format("Y-m-d"))->where('State', 0);
                    $copi = json_decode( json_encode($copi),true);
                    foreach ($copi as $key => $val) {
                        DetalleConteos1::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $val['id'],
                            "State" => 0,
                        ]);
                        DetalleConteos2::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $val['id'],
                            "State" => 0,
                        ]);
                        DetalleConteos3::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $val['id'],
                            "State" => 1,
                        ]);
                        $cop = CopiaWMS::where('id', $val['id'])->update([
                            'State' => 1,
                        ]);
                    }
                }
            }
            if (isset($input["zona_pasillo"])) {
                
                foreach($input['zona_pasillo'] as $key => $value){
                    
                    $param = explode("-", $value);

                    $result = CopiaWMS::all()->where('Zone', $param[0])->where('Hallway', $param[1])->where('DateCopy', $fecha_hora->format("Y-m-d"))->where('State', 0);
                    $result = json_decode( json_encode($result),true);
                
                    foreach ($result as $key => $values) {
                        DetalleConteos1::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 0,
                        ]);
                        DetalleConteos2::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 0,
                        ]);
                        DetalleConteos3::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 1,
                        ]);
                        $cop = CopiaWMS::where('id', $values['id'])->update([
                            'State' => 1,
                        ]);
                    }
                }
            }
            if (isset($input["productos"])) {
                
                foreach($input['productos'] as $key => $value){
                    $result = CopiaWMS::all()->where('ItemCode', $value)->where('DateCopy', $fecha_hora->format("Y-m-d"))->where('State', 0);
                    $result = json_decode( json_encode($result),true);
                
                    foreach ($result as $key => $values) {
                        DetalleConteos1::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 0,
                        ]);
                        DetalleConteos2::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 0,
                        ]);
                        DetalleConteos3::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 1,
                        ]);
                        $cop = CopiaWMS::where('id', $values['id'])->update([
                            'State' => 1,
                        ]);
                    }
                }
            }
            if (isset($input["ubicacion"])) {
                
                foreach($input['ubicacion'] as $key => $value){

                    $result = CopiaWMS::all()->where('Location', $value)->where('DateCopy', $fecha_hora->format("Y-m-d"))->where('State', 0);
                    $result = json_decode( json_encode($result),true);
                
                    foreach ($result as $key => $values) {
                        DetalleConteos1::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 0,
                        ]);
                        DetalleConteos2::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 0,
                        ]);
                        DetalleConteos3::create([
                            "Conteo_id" => $conteo['id'],
                            "Copia_id" => $values['id'],
                            "State" => 1,
                        ]);
                        $cop = CopiaWMS::where('id', $values['id'])->update([
                            'State' => 1,
                        ]);
                    }
                }
            }
            if (isset($input["random"])) {
                $inicio = DB::select('select top 1 id from CopiaWMS where 
                DateCopy = CONVERT (date, GETDATE())');
                $inicio = json_decode( json_encode($inicio),true);

                $fin = DB::select('select top 1 id from CopiaWMS where 
                DateCopy = CONVERT (date, GETDATE()) ORDER BY id DESC');
                $fin = json_decode( json_encode($fin),true);
                $ini =$inicio[0]['id'];
                $fn =$fin[0]['id'];

                for ($i=0; $i < 6; $i++) { 
                    $registros = DB::select('select id from CopiaWMS where 
                    DateCopy = CONVERT (date, GETDATE()) 
                    and State = 0
                    and id = FLOOR(RAND()*('.$fn.'-'.$ini.')+'.$ini.')');
                    $registros = json_decode( json_encode($registros),true);
                    $numero = $registros[0]['id'];

                    // dd($numero);

                    DetalleConteos1::create([
                        "Conteo_id" => $conteo['id'],
                        "Copia_id" => $numero,
                        "State" => 0,
                    ]);
                    DetalleConteos2::create([
                        "Conteo_id" => $conteo['id'],
                        "Copia_id" => $numero,
                        "State" => 0,
                    ]);
                    DetalleConteos3::create([
                        "Conteo_id" => $conteo['id'],
                        "Copia_id" => $numero,
                        "State" => 1,
                    ]);
                    $cop = CopiaWMS::where('id', $numero)->update([
                        'State' => 1,
                    ]);
                }
            }
        DB::commit();
        Alert::success('Asignado', 'Conteo asignado exitosamente.');
        return redirect()->route('asignar.index');
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

    public function Asignation3($id)
    {
        // dd($id);
        // $id = strval($id);
        
        $job = DB::select("
            select 
                A.Conteo_id,
                A.Copia_id,
                A.ItemCode as Cod1,
                A.Amount as cant1,
                A.Lote as Lote1,
                A.DateExpiration as Expiration1,
                b.ItemCode as Cod2,
                b.Amount as cant2,
                b.Lote as Lote2,
                b.DateExpiration as Expiration2
            from
            DetalleConteos1 A INNER JOIN DetalleConteos2 b ON a.Conteo_id = b.Conteo_id and a.id = b.id
            where (a.ItemCode <> b.ItemCode or a.Amount <> b.Amount or a.Lote <> b.lote or a.DateExpiration <> b.DateExpiration) and a.Conteo_id =
        ".$id);

        if ($job !== []) {
            foreach ($job as $key => $value) {
                $conteo = $value->Conteo_id;
                $copia = $value->Copia_id;
    
                $chage = DetalleConteos3::where('Conteo_id', $conteo)->where('Copia_id', $copia)
                ->update([
                    'State' => 0,
                ]);
            }
            $detalle = Conteos::select(
                'Conteos.id as id_cont',
                'Conteos.State3 as StateCont', 
                'Conteos.Model_id', 
                'DetalleConteos3.State as StateLine',
                'CopiaWMS.*'
                )
            ->join('DetalleConteos3', 'Conteos.id', '=', 'DetalleConteos3.Conteo_id')
            ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
            ->where('Conteos.id', $id)
            ->where('DetalleConteos3.State', 0)
            ->get();
    
            $detalle = json_decode( json_encode($detalle),true);
            
            $usuarios = User::all();
            $usuarios = json_decode( json_encode( $usuarios),true);
            
            $TipoConteo = ModelosRecuento::all();
            $TipoConteo = json_decode( json_encode( $TipoConteo),true);
    
            return view('pages.administrador.stractWMS.FormAsignC3', compact('id','usuarios', 'TipoConteo','detalle'));
        }else {
            
            $changeState = Conteos::find($id)->update([
                'State3' => 1,
            ]);

            Alert::warning('Conteo 3', 'No es necesario Realizar un tercer conteo');
            return redirect()->route('asignar.index');

        }
    }

    public function storeAs3(Request $request, $id)
    {
        $items = $request->all();

        $asign = Conteos::where('id', $id)->update([
            'User3'=>$items['user3'],
        ]);

        return redirect()->route('asignar.index');
    }
}
