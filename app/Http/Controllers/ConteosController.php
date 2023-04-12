<?php

namespace App\Http\Controllers;

use App\Models\Conteos;
use App\Models\CopiaWMS;
use App\Models\DetalleConteos;
use App\Models\DetalleConteos1;
use App\Models\DetalleConteos2;
use App\Models\DetalleConteos3;
use App\Models\ModelosRecuento;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ConteosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha_hora = new DateTime('now', new DateTimeZone('America/Bogota'));

        $TipoConteo = ModelosRecuento::all();
        $TipoConteo = json_decode(json_encode($TipoConteo), true);

        $conteo1 = Conteos::all()
            ->where('User1', Auth::user()->id)
            ->where('DateAsign', $fecha_hora->format('Y-m-d'))
            ->where('State1', 0);
        $WMS1 = json_decode(json_encode($conteo1), true);

        $conteo2 = Conteos::all()
            ->where('User2', Auth::user()->id)
            ->where('DateAsign', $fecha_hora->format('Y-m-d'))
            ->where('State2', 0)
            ->where('State1', 1);
        $WMS2 = json_decode(json_encode($conteo2), true);

        $conteo3 = Conteos::all()
            ->where('User3', Auth::user()->id)
            ->where('DateAsign', $fecha_hora->format('Y-m-d'))
            ->where('State3', 0)
            ->where('State1', 1)
            ->where('State2', 1);
        $WMS3 = json_decode(json_encode($conteo3), true);

        return view(
            'pages.operarios.Conteos.ListConteos',
            compact('TipoConteo', 'WMS1', 'WMS2', 'WMS3')
        );
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        session_start();
        if ($_SESSION['NCONTEO'] == 'c1') {
            $detalleRes = DetalleConteos1::select('Conteo_id')
                ->where('id', $id)
                ->get();
            $detalleRes = json_decode(json_encode($detalleRes), true);
            $idConteo = $detalleRes[0]['Conteo_id'];
            $tipoc = Conteos::select('Model_id')
                ->where('id', $idConteo)
                ->get();
            $tipoc = json_decode(json_encode($tipoc), true);
            $tipoc = $tipoc[0]['Model_id'];
            if ($tipoc == 1) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User1 as u1',
                    'Conteos.Model_id',
                    'Conteos.State31 as State_cont',
                    'DetalleConteos1.id as d_id',
                    'DetalleConteos1.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos1',
                        'Conteos.id',
                        '=',
                        'DetalleConteos1.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos1.Copia_id'
                    )
                    ->where('DetalleConteos1.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Ciegos.FormConteoCiegos',
                    compact('id', 'response', 'BarCodes')
                );
            } elseif ($tipoc == 2) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User1 as u1',
                    'Conteos.Model_id',
                    'Conteos.State1 as State_cont',
                    'DetalleConteos1.id as d_id',
                    'DetalleConteos1.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos1',
                        'Conteos.id',
                        '=',
                        'DetalleConteos1.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos1.Copia_id'
                    )
                    ->where('DetalleConteos1.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Guiados.FormConteoGuiados',
                    compact('id', 'response', 'BarCodes')
                );
            } elseif ($tipoc == 3) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User1 as u1',
                    'Conteos.Model_id',
                    'Conteos.State1 as State_cont',
                    'DetalleConteos1.id as d_id',
                    'DetalleConteos1.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos1',
                        'Conteos.id',
                        '=',
                        'DetalleConteos1.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos1.Copia_id'
                    )
                    ->where('DetalleConteos1.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Semiguiados.FormConteoSemiG',
                    compact('id', 'response', 'BarCodes')
                );
            }
        } elseif ($_SESSION['NCONTEO'] == 'c2') {
            $detalleRes = DetalleConteos2::select('Conteo_id')
                ->where('id', $id)
                ->get();
            $detalleRes = json_decode(json_encode($detalleRes), true);
            $idConteo = $detalleRes[0]['Conteo_id'];
            $tipoc = Conteos::select('Model_id')
                ->where('id', $idConteo)
                ->get();
            $tipoc = json_decode(json_encode($tipoc), true);
            $tipoc = $tipoc[0]['Model_id'];
            if ($tipoc == 1) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User2 as user',
                    'Conteos.Model_id',
                    'Conteos.State2 as State_cont',
                    'DetalleConteos2.id as d_id',
                    'DetalleConteos2.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos2',
                        'Conteos.id',
                        '=',
                        'DetalleConteos2.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos2.Copia_id'
                    )
                    ->where('DetalleConteos2.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Ciegos.FormConteoCiegos',
                    compact('id', 'response', 'BarCodes')
                );
            } elseif ($tipoc == 2) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User2 as u2',
                    'Conteos.Model_id',
                    'Conteos.State2 as State_cont',
                    'DetalleConteos2.id as d_id',
                    'DetalleConteos2.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos2',
                        'Conteos.id',
                        '=',
                        'DetalleConteos2.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos2.Copia_id'
                    )
                    ->where('DetalleConteos2.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Guiados.FormConteoGuiados',
                    compact('id', 'response', 'BarCodes')
                );
            } elseif ($tipoc == 3) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User2 as u2',
                    'Conteos.Model_id',
                    'Conteos.State2 as State_cont',
                    'DetalleConteos2.id as d_id',
                    'DetalleConteos2.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos2',
                        'Conteos.id',
                        '=',
                        'DetalleConteos2.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos2.Copia_id'
                    )
                    ->where('DetalleConteos2.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Semiguiados.FormConteoSemiG',
                    compact('id', 'response', 'BarCodes')
                );
            }
        } elseif ($_SESSION['NCONTEO'] == 'c3') {
            $detalleRes = DetalleConteos3::select('Conteo_id')
                ->where('id', $id)
                ->get();
            $detalleRes = json_decode(json_encode($detalleRes), true);
            $idConteo = $detalleRes[0]['Conteo_id'];
            $tipoc = Conteos::select('Model_id')
                ->where('id', $idConteo)
                ->get();
            $tipoc = json_decode(json_encode($tipoc), true);
            $tipoc = $tipoc[0]['Model_id'];
            if ($tipoc == 1) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User3 as user',
                    'Conteos.Model_id',
                    'Conteos.State3 as State_cont',
                    'DetalleConteos3.id as d_id',
                    'DetalleConteos3.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos3',
                        'Conteos.id',
                        '=',
                        'DetalleConteos3.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos3.Copia_id'
                    )
                    ->where('DetalleConteos3.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Ciegos.FormConteoCiegos',
                    compact('id', 'response', 'BarCodes')
                );
            } elseif ($tipoc == 2) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User3 as u3',
                    'Conteos.Model_id',
                    'Conteos.State3 as State_cont',
                    'DetalleConteos3.id as d_id',
                    'DetalleConteos3.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos3',
                        'Conteos.id',
                        '=',
                        'DetalleConteos3.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos3.Copia_id'
                    )
                    ->where('DetalleConteos3.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Guiados.FormConteoGuiados',
                    compact('id', 'response', 'BarCodes')
                );
            } elseif ($tipoc == 3) {
                $response = Conteos::select(
                    'Conteos.id',
                    'Conteos.User3 as u3',
                    'Conteos.Model_id',
                    'Conteos.State3 as State_cont',
                    'DetalleConteos3.id as d_id',
                    'DetalleConteos3.State as State_line',
                    'CopiaWMS.ItemCode',
                    'CopiaWMS.Description',
                    'CopiaWMS.BarCode',
                    'CopiaWMS.Amount',
                    'CopiaWMS.Lote',
                    'CopiaWMS.DateExpiration',
                    'CopiaWMS.Zone',
                    'CopiaWMS.Hallway',
                    'CopiaWMS.Location',
                    'CopiaWMS.Compartment',
                    'CopiaWMS.DateCopy',
                    'CopiaWMS.State as State_Copy'
                )
                    ->join(
                        'DetalleConteos3',
                        'Conteos.id',
                        '=',
                        'DetalleConteos3.Conteo_id'
                    )
                    ->join(
                        'CopiaWMS',
                        'CopiaWMS.id',
                        '=',
                        'DetalleConteos3.Copia_id'
                    )
                    ->where('DetalleConteos3.id', $id)
                    ->get();

                $response = json_decode(json_encode($response), true);

                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                return view(
                    'pages.operarios.Semiguiados.FormConteoSemiG',
                    compact('id', 'response', 'BarCodes')
                );
            }
        }
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
        session_start();

        $input = $request->all();

        DB::beginTransaction();

        if ($_SESSION['NCONTEO'] == 'c1') {
            DetalleConteos1::where('id', $id)->update([
                'Comments' => $input['Coments'],
                'ItemCode' => $input['ItemCode'],
                'Amount' => $input['Amount'],
                'Lote' => $input['Lote'],
                'DateExpiration' => $input['fecha'],
                'State' => 1,
            ]);

            $detalle = DetalleConteos1::find($id);
            $detalle = json_decode(json_encode($detalle), true);
        } elseif ($_SESSION['NCONTEO'] == 'c2') {
            
                DetalleConteos2::where('id', $id)->update([
                    'Comments' => $input['Coments'],
                    'ItemCode' => $input['ItemCode'],
                    'Amount' => $input['Amount'],
                    'Lote' => $input['Lote'],
                    'DateExpiration' => $input['fecha'],
                    'State' => 1,
                ]);
            $detalle = DetalleConteos2::find($id);
            $detalle = json_decode(json_encode($detalle), true);
        } elseif ($_SESSION['NCONTEO'] == 'c3') {
            DetalleConteos3::where('id', $id)->update([
                'Comments' => $input['Coments'],
                'ItemCode' => $input['ItemCode'],
                'Amount' => $input['Amount'],
                'Lote' => $input['Lote'],
                'DateExpiration' => $input['fecha'],
                'State' => 1,
            ]);

            $detalle = DetalleConteos3::find($id);
            $detalle = json_decode(json_encode($detalle), true);
        }

        DB::commit();

        Alert::success('Conteo', 'detalle contado exitosamente.');
        return redirect()->route('Ubicaciones', [
            'id' => $detalle['Conteo_id'],
            'ncount' => $_SESSION['NCONTEO'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function ChangeState($id)
    {
        session_start();
        if ($_SESSION['NCONTEO'] == 'c1') {
            Conteos::where('id', $id)->update([
                'State1' => 1,
            ]);
        } elseif ($_SESSION['NCONTEO'] == 'c2') {
            Conteos::where('id', $id)->update([
                'State2' => 1,
            ]);
        } elseif ($_SESSION['NCONTEO'] == 'c3') {
            Conteos::where('id', $id)->update([
                'State3' => 1,
            ]);
        }
        Alert::success('Conteo', 'Conteo finalizado exitosamente.');
        return redirect()->route('conteos.index');
    }

    
}
