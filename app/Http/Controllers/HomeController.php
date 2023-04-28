<?php

namespace App\Http\Controllers;

use App\Models\Conteos;
use App\Models\CopiaWMS;
use App\Models\ModelosRecuento;
use App\Models\PedidoSap;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        // $response = Http::retry(30, 5, throw: false)->post('https://10.170.20.95:50000/b1s/v1/Login',[
        //     'CompanyDB' => 'ZPRUREBANO',
        //     'UserName' => 'Desarrollos',
        //     'Password' => 'Asdf1234$',
        // ])['SessionId'];
        
        // $pedido = PedidoSap::all()->where('ESTADO_ID', 3);
        // foreach ($pedido as $key => $value) {
        //     $gard = Http::retry(30, 5, throw: false)->withToken($response)->patch("https://10.170.20.95:50000/b1s/v1/DeliveryNotes(".$value->DOCUMENTO.")", [
        //         "U_IV_FECHREC"=>$value->updated_at,
        //         "U_IV_INIREC" => $value->HORA_INICIO_REC,
        //         "U_IN_FINREC"=> $value->HORA_FIN_REC,
        //         "U_IV_PATINADOR"=> $value->RECOLECTOR
        //     ]);
        // }
        $fecha_hora = new DateTime("now", new DateTimeZone('America/Bogota'));

        $TipoConteo = ModelosRecuento::all();
        $TipoConteo = json_decode( json_encode( $TipoConteo),true);
    
        $WMS1 = Conteos::all()->where('User1',  Auth::user()->id)->where('DateAsign', $fecha_hora->format('Y-m-d'))->where("State1", 0)->count();

        $WMS2 = Conteos::all()->where('User2',  Auth::user()->id)->where('DateAsign', $fecha_hora->format('Y-m-d'))->where("State2", 0)->where("State1", 1)->count();
        
        $WMS3 = Conteos::all()->where('User3',  Auth::user()->id)->where('DateAsign', $fecha_hora->format('Y-m-d'))->where("State3", 0)->where("State1", 1)->where("State2", 1)->count();

        $total = $WMS1+$WMS2+$WMS3;

        return view('home', compact('total','TipoConteo','WMS1', 'WMS2', 'WMS3'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //   
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
        $response = Conteos::select('Conteos.*', 'CopiaWMS.*')->join('DetalleConteos', 'Conteos.id',"=", "DetalleConteos.Conteo_id")
        ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos.Copia_id')
        ->where('Conteos.id', $id)
        ->get();
        $response = json_decode( json_encode($response),true);
        dd($response);
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
