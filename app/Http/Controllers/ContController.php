<?php

namespace App\Http\Controllers;

use App\Http\Requests\formUbicacion;
use App\Models\Conteos;
use App\Models\CopiaWMS;
use App\Models\DetalleConteos1;
use App\Models\DetalleConteos2;
use App\Models\DetalleConteos3;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ContController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Lista($id)
    {
        session_start();
        
        $ncount = $_SESSION['NCONTEO'];
        $tipoc = Conteos::select('Model_id')->where('id', $id)->get();
        $tipoc = json_decode( json_encode($tipoc),true);
        $tipoc = $tipoc[0]['Model_id'];
        // dd($tipoc);
        if($ncount == 'c1') {
            if($tipoc == 1){
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                // ->where('DetalleConteos1.State', 0)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
                
                return view('pages.operarios.Ciegos.ListConteosCiegos', compact('NR','response'));

            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                ->get();
                
                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);

                return view('pages.operarios.Guiados.ListConteosGuiados', compact('NR','response'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
    
                return view('pages.operarios.Semiguiados.ListConteosSemiG', compact('NR','response'));
            }
        }elseif ($ncount == 'c2'){
            if($tipoc == 1){
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
                
                return view('pages.operarios.Ciegos.ListConteosCiegos', compact('NR','response'));

            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->get();
                
                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);

                return view('pages.operarios.Guiados.ListConteosGuiados', compact('NR','response'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
    
                return view('pages.operarios.Semiguiados.ListConteosSemiG', compact('NR','response'));
            }
        }elseif ($ncount == 'c3') {
            if($tipoc == 1){
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
                
                return view('pages.operarios.Ciegos.ListConteosCiegos', compact('NR','response'));

            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->get();
                
                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);

                return view('pages.operarios.Guiados.ListConteosGuiados', compact('NR','response'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
    
                return view('pages.operarios.Semiguiados.ListConteosSemiG', compact('NR','response'));
            }
        }

    }
    
    public function FormUbi($id, $ncount)
    {
        session_start();
        
        $_SESSION['NCONTEO'] = $ncount;
        $tipoc = Conteos::select('Model_id')->where('id', $id)->get();
        $tipoc = json_decode( json_encode($tipoc),true);
        $tipoc = $tipoc[0]['Model_id'];
        // dd($tipoc);
        if($ncount == 'c1') {
            if($tipoc == 1){
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos1.State', 0)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
                
                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }
                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }

                return view('pages.operarios.Ciegos.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));

            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos1.State', 0)
                ->get();
                
                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);

                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }
                
                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }

                return view('pages.operarios.Guiados.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos1.State', 0)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
    
                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }
                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }

                return view('pages.operarios.Semiguiados.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));
            }
        }elseif ($ncount == 'c2'){
            if($tipoc == 1){
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos2.State', 0)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
                
                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }

                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }
                

                return view('pages.operarios.Ciegos.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));

            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos2.State', 0)
                ->get();
                
                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);

                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }

                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }

                return view('pages.operarios.Guiados.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos2.State', 0)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
    
                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }
                
                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }

                return view('pages.operarios.Semiguiados.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));
            }
        }elseif ($ncount == 'c3') {
            if($tipoc == 1){
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos3.State', 0)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
                
                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }
                
                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }

                return view('pages.operarios.Ciegos.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));

            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos3.State', 0)
                ->get();
                
                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);

                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }
                
                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }

                return view('pages.operarios.Guiados.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos3.State', 0)
                ->get();

                $NR = $response->where('State_line', 0)->count();
                
                $response = json_decode( json_encode($response),true);
    
                $zonas = [];
                foreach ($response as $key => $value) {
                    $zona = $value['Zone'];
                    if (!in_array($zona, $zonas)) {
                        $zonas[] = $zona;
                    }
                }
                
                $pasillos = [];
                foreach ($response as $key => $value) {
                    $pasillo = $value['Hallway'];
                    if (!in_array($pasillo, $pasillos)) {
                        $pasillos[] = $pasillo;
                    }
                }
                
                $ubi = [];
                foreach ($response as $key => $value) {
                    $ubicacion = $value['Location'];
                    if (!in_array($ubicacion, $ubi)) {
                        $ubi[] = $ubicacion;
                    }
                }

                return view('pages.operarios.Semiguiados.FormUbicacion', compact('id','NR', 'ubi', 'response', 'zonas', 'pasillos'));
            }
        }

    }

    public function ubiSearch(formUbicacion $request, $id)
    {
        $inputs = $request->all();
        
        session_start();        
        if($_SESSION['NCONTEO'] == 'c1') {
            $tipoc = Conteos::select('Model_id')->where('id', $id)->get();
            $tipoc = json_decode( json_encode($tipoc),true);
            $tipoc = $tipoc[0]['Model_id'];
            
            if($tipoc == 1){

                $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
                FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
                
                $productos = json_decode( json_encode($productos),true);
                
                $BarCodes = [];
                foreach ($productos as $key => $val) {
                    array_push($BarCodes, $val['CODIGO_BARRAS']);
                }

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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos1.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode(json_encode($response),true);


                
                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }
                
                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }
                return view('pages.operarios.Ciegos.FormConteoCiegos', compact('id', 'ubicacion', 'productos', 'response', 'BarCodes'));
            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos1.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode( json_encode($response),true);

                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }
                $BarCodes = [];

                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }
                
                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }
    
                return view('pages.operarios.Guiados.FormConteoGuiados', compact('id', 'ubicacion', 'response', 'BarCodes'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos1', 'Conteos.id',"=", "DetalleConteos1.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos1.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos1.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode( json_encode($response),true);
                
                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }
                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }
                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }

                return view('pages.operarios.Semiguiados.FormConteoSemiG', compact('id', 'ubicacion', 'response', 'BarCodes'));
            }
        }elseif ($_SESSION['NCONTEO'] == 'c2'){
            $tipoc = Conteos::select('Model_id')->where('id', $id)->get();
            $tipoc = json_decode( json_encode($tipoc),true);
            $tipoc = $tipoc[0]['Model_id'];
            
            if($tipoc == 1){
                
                $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
                FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
                
                $productos = json_decode( json_encode($productos),true);
                
                $BarCodes = [];
                foreach ($productos as $key => $val) {
                    array_push($BarCodes, $val['CODIGO_BARRAS']);
                }

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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos2.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode( json_encode($response),true);
                
                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }

                
                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }
                return view('pages.operarios.Ciegos.FormConteoCiegos', compact('id','response', 'ubicacion',  'productos', 'BarCodes'));
            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos2.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode( json_encode($response),true);

                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }
                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }
    
                return view('pages.operarios.Guiados.FormConteoGuiados', compact('id', 'ubicacion', 'response', 'BarCodes'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos2', 'Conteos.id',"=", "DetalleConteos2.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos2.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos2.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode( json_encode($response),true);
                
                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }
                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }

                return view('pages.operarios.Semiguiados.FormConteoSemiG', compact('id', 'ubicacion', 'response', 'BarCodes'));
            }
        }elseif ($_SESSION['NCONTEO'] == 'c3') {
            $tipoc = Conteos::select('Model_id')->where('id', $id)->get();
            $tipoc = json_decode( json_encode($tipoc),true);
            $tipoc = $tipoc[0]['Model_id'];
            
            if($tipoc == 1){
                $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
                FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
                
                $productos = json_decode( json_encode($productos),true);
                
                $BarCodes = [];
                foreach ($productos as $key => $val) {
                    array_push($BarCodes, $val['CODIGO_BARRAS']);
                }

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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos3.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode( json_encode($response),true);
                
                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }

                
                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }
                return view('pages.operarios.Ciegos.FormConteoCiegos', compact('id', 'ubicacion', 'response', 'productos', 'BarCodes'));
            }elseif ($tipoc == 2) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos3.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode( json_encode($response),true);

                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }
                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

    
                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }
                return view('pages.operarios.Guiados.FormConteoGuiados', compact('id', 'ubicacion', 'response', 'BarCodes'));
            }elseif ($tipoc == 3) {
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
                    'CopiaWMS.State as State_Copy',
                )
                ->join('DetalleConteos3', 'Conteos.id',"=", "DetalleConteos3.Conteo_id")
                ->join('CopiaWMS', 'CopiaWMS.id', '=', 'DetalleConteos3.Copia_id')
                ->where('Conteos.id', $id)
                ->where('DetalleConteos3.State', 0)
                ->where('CopiaWMS.Zone', $inputs['Zone'])
                ->where('CopiaWMS.Hallway', $inputs['Hallway'])
                ->where('CopiaWMS.Location', $inputs['Location'])
                ->get();
                
                $response = json_decode( json_encode($response),true);
                
                if ($response == []) {
                    Alert::warning('Ubicacion', 'Ubicacion no existente o no se te fue asignada.');
                    return redirect()->back();
                }
                $BarCodes = [];
                foreach ($response as $key => $val) {
                    array_push($BarCodes, $val['BarCode']);
                }

                foreach ($response as $key => $val) {
                    $ubicacion = $val['Location'];
                }

                return view('pages.operarios.Semiguiados.FormConteoSemiG', compact('id', 'ubicacion', 'response', 'BarCodes'));
            }
        }
    }

    public function FormNewProd($id)
    {

        session_start();        
        if($_SESSION['NCONTEO'] == 'c1') {
            $detalle = DetalleConteos1::select(
                "DetalleConteos1.*"
                ,"CopiaWMS.Zone"
                ,"CopiaWMS.Hallway"
                ,"CopiaWMS.Location"
                )
            ->join('CopiaWMS', 'CopiaWMS.id','=', 'DetalleConteos1.Copia_id')
            ->where('DetalleConteos1.id', '=', $id)
            ->get();

            $detalle = json_decode( json_encode($detalle),true);

            $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
            FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
            
            $productos = json_decode( json_encode($productos),true);

            return view('pages.operarios.FormGen.FormNewProd', compact('id', 'detalle', 'productos'));


        }elseif ($_SESSION['NCONTEO'] == 'c2'){     
                $detalle = DetalleConteos2::select(
                    "DetalleConteos2.*"
                    ,"CopiaWMS.Zone"
                    ,"CopiaWMS.Hallway"
                    ,"CopiaWMS.Location"
                    )
                ->join('CopiaWMS', 'CopiaWMS.id','=', 'DetalleConteos2.Copia_id')
                ->where('DetalleConteos2.id', '=', $id)
                ->get();
    
                $detalle = json_decode( json_encode($detalle),true);
                // dd($detalle);
    
                $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
                FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
                
                $productos = json_decode( json_encode($productos),true);
    
                return view('pages.operarios.FormGen.FormNewProd', compact('id', 'detalle', 'productos'));
    
    
        }elseif ($_SESSION['NCONTEO'] == 'c3') {  
            $detalle = DetalleConteos3::select(
                "DetalleConteos3.*"
                ,"CopiaWMS.Zone"
                ,"CopiaWMS.Hallway"
                ,"CopiaWMS.Location"
                )
            ->join('CopiaWMS', 'CopiaWMS.id','=', 'DetalleConteos3.Copia_id')
            ->where('DetalleConteos3.id', '=', $id)
            ->get();

            $detalle = json_decode( json_encode($detalle),true);

            $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
            FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
            
            $productos = json_decode( json_encode($productos),true);

            return view('pages.operarios.FormGen.FormNewProd', compact('id', 'detalle', 'productos'));

        }
    }
    
    public function storeNewProd(Request $request, $id)
    {
        $input = $request->all();
        
        $desc = '';

        if (isset($input['Description'])) {
            $desc = $input['Description'];
        }elseif (isset($input['ItemName'])) {
            $desc = $input['ItemName'];
        }
        
        $fecha_hora = new DateTime("now", new DateTimeZone('America/Bogota'));

        session_start();        
        if($_SESSION['NCONTEO'] == 'c1') {

            DB::beginTransaction();
                $det = DetalleConteos1::find($id);

                $det->update([
                    'Comments' => "Se reemplazo un producto en esta posicon con el codigo: ".$input['ItemCode'],
                    'ItemCode' => "N/A",
                    'Amount' => 0,
                    'Lote' => "N/A",
                    'DateExpiration' => '',
                    'State' => 1,
                ]);
                $det = json_decode( json_encode($det),true);

                $detail = $det['Conteo_id'];

                $crearcopia = CopiaWMS::create([
                    'ItemCode' => $input['ItemCode'],
                    'Description'=> $desc,
                    'BarCode'=> $input['barcode'],
                    'Amount'=> $input['Amount'],
                    'Lote'=> $input['Lote'],
                    'DateExpiration'=> $input['Expiration'],
                    'Zone'=> $input['Zone'],
                    'Hallway'=> $input['Hallway'],
                    'Location'=> $input['Location'],
                    'New' => 'si',
                    'DateCopy' => $fecha_hora->format('Y-m-d'),
                    'HourCopy' => $fecha_hora->format('H:i:s'),
                    'State' => 1,
                ]);
                $crearcopia = json_decode( json_encode($crearcopia),true);

                $copi = $crearcopia['id'];

                $creardetalle = DetalleConteos1::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    'Comments' => "producto agregado en posicion.",
                    "ItemCode" => $input['ItemCode'],
                    "Amount"=> $input['Amount'],
                    "Lote"=> $input['Lote'],
                    "DateExpiration"=> $input['Expiration'],
                    "State" => 1,
                ]);
                DetalleConteos2::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
                DetalleConteos3::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
            DB::commit();
            Alert::success('Se agrego', 'se agrego el producto exitosamente.');
            return redirect()->route('Ubicaciones', [
                'id' => $detail,
                'ncount' => $_SESSION['NCONTEO'],
            ]);

        }elseif ($_SESSION['NCONTEO'] == 'c2'){     

            DB::beginTransaction();
                $det = DetalleConteos2::find($id);

                $det->update([
                    'Comments' => "Se reemplazo un producto en esta posicon con el codigo: ".$input['ItemCode'],
                    'ItemCode' => "N/A",
                    'Amount' => 0,
                    'Lote' => "N/A",
                    'DateExpiration' => '',
                    'State' => 1,
                ]);
                $det = json_decode( json_encode($det),true);

                $detail = $det['Conteo_id'];

                $crearcopia = CopiaWMS::create([
                    'ItemCode' => $input['ItemCode'],
                    'Description'=> $desc,
                    'BarCode'=> $input['barcode'],
                    'Amount'=> $input['Amount'],
                    'Lote'=> $input['Lote'],
                    'DateExpiration'=> $input['Expiration'],
                    'Zone'=> $input['Zone'],
                    'Hallway'=> $input['Hallway'],
                    'Location'=> $input['Location'],
                    'New' => 'si',
                    'DateCopy' => $fecha_hora->format('Y-m-d'),
                    'HourCopy' => $fecha_hora->format('H:i:s'),
                    'State' => 1,
                ]);
                $crearcopia = json_decode( json_encode($crearcopia),true);

                $copi = $crearcopia['id'];

                $creardetalle = DetalleConteos2::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    'Comments' => "producto agregado en posicion.",
                    "ItemCode" => $input['ItemCode'],
                    "Amount"=> $input['Amount'],
                    "Lote"=> $input['Lote'],
                    "DateExpiration"=> $input['Expiration'],
                    "State" => 1,
                ]);
                DetalleConteos1::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
                DetalleConteos3::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
            DB::commit();
            Alert::success('Se agrego', 'se agrego el producto exitosamente.');
            return redirect()->route('Ubicaciones', [
                'id' => $detail,
                'ncount' => $_SESSION['NCONTEO'],
            ]);
        }elseif ($_SESSION['NCONTEO'] == 'c3') {  

            DB::beginTransaction();
                $det = DetalleConteos3::find($id);

                $det->update([
                    'Comments' => "Se reemplazo un producto en esta posicon con el codigo: ".$input['ItemCode'],
                    'ItemCode' => "N/A",
                    'Amount' => 0,
                    'Lote' => "N/A",
                    'DateExpiration' => '',
                    'State' => 1,
                ]);
                $det = json_decode( json_encode($det),true);

                $detail = $det['Conteo_id'];

                $crearcopia = CopiaWMS::create([
                    'ItemCode' => $input['ItemCode'],
                    'Description'=> $desc,
                    'BarCode'=> $input['barcode'],
                    'Amount'=> $input['Amount'],
                    'Lote'=> $input['Lote'],
                    'DateExpiration'=> $input['Expiration'],
                    'Zone'=> $input['Zone'],
                    'Hallway'=> $input['Hallway'],
                    'Location'=> $input['Location'],
                    'New' => 'si',
                    'DateCopy' => $fecha_hora->format('Y-m-d'),
                    'HourCopy' => $fecha_hora->format('H:i:s'),
                    'State' => 1,
                ]);
                $crearcopia = json_decode( json_encode($crearcopia),true);

                $copi = $crearcopia['id'];

                $creardetalle = DetalleConteos3::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    'Comments' => "producto agregado en posicion.",
                    "ItemCode" => $input['ItemCode'],
                    "Amount"=> $input['Amount'],
                    "Lote"=> $input['Lote'],
                    "DateExpiration"=> $input['Expiration'],
                    "State" => 1,
                ]);
                DetalleConteos2::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
                DetalleConteos1::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
            DB::commit();
            Alert::success('Se agrego', 'se agrego el producto exitosamente.');
            return redirect()->route('Ubicaciones', [
                'id' => $detail,
                'ncount' => $_SESSION['NCONTEO'],
            ]);
        }
    }

    public function countAgre(Request $request, $id)
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
        // dd($id);

        Alert::success('Conteo', 'detalle contado exitosamente.');
        return redirect()->route('formnew', $id);
    }

    public function Agre($id)
    {
        session_start();        
        if($_SESSION['NCONTEO'] == 'c1') {
            $detalle = DetalleConteos1::select(
                "DetalleConteos1.*"
                ,"CopiaWMS.Zone"
                ,"CopiaWMS.Hallway"
                ,"CopiaWMS.Location"
                )
            ->join('CopiaWMS', 'CopiaWMS.id','=', 'DetalleConteos1.Copia_id')
            ->where('DetalleConteos1.id', '=', $id)
            ->get();

            $detalle = json_decode( json_encode($detalle),true);

            $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
            FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
            
            $productos = json_decode( json_encode($productos),true);
            // dd($id);

            return view('pages.operarios.FormGen.FormAgre', compact('id', 'detalle', 'productos'));


        }elseif ($_SESSION['NCONTEO'] == 'c2'){     
                $detalle = DetalleConteos2::select(
                    "DetalleConteos2.*"
                    ,"CopiaWMS.Zone"
                    ,"CopiaWMS.Hallway"
                    ,"CopiaWMS.Location"
                    )
                ->join('CopiaWMS', 'CopiaWMS.id','=', 'DetalleConteos2.Copia_id')
                ->where('DetalleConteos2.id', '=', $id)
                ->get();
    
                $detalle = json_decode( json_encode($detalle),true);
    
                $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
                FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
                
                $productos = json_decode( json_encode($productos),true);
    
                return view('pages.operarios.FormGen.FormAgre', compact('id', 'detalle', 'productos'));
    
    
        }elseif ($_SESSION['NCONTEO'] == 'c3') {  
            $detalle = DetalleConteos3::select(
                "DetalleConteos3.*"
                ,"CopiaWMS.Zone"
                ,"CopiaWMS.Hallway"
                ,"CopiaWMS.Location"
                )
            ->join('CopiaWMS', 'CopiaWMS.id','=', 'DetalleConteos3.Copia_id')
            ->where('DetalleConteos3.id', '=', $id)
            ->get();

            $detalle = json_decode( json_encode($detalle),true);

            $productos = DB::select('SELECT DISTINCT D.ART_ARTICOLO,D.ART_DES AS Descripcion,F.ALT_CODICE_ALTERNATIVO AS CODIGO_BARRAS
            FROM SYSTOREDB.dbo.DAT_ARTICOLI AS D INNER JOIN SYSTOREDB.dbo.DAT_ARTICOLI_ALTCODICI AS F ON F.ALT_ARTICOLO = D.ART_ARTICOLO');
            
            $productos = json_decode( json_encode($productos),true);

            return view('pages.operarios.FormGen.FormAgre', compact('id', 'detalle', 'productos'));

        }
    }

    public function StoreAgre(Request $request, $id)
    {
        $input = $request->all();
        // dd($id);
        $desc = '';
        if (isset($input['Description'])) {
            $desc = $input['Description'];
        }elseif (isset($input['ItemName'])) {
            $desc = $input['ItemName'];
        }
        $fecha_hora = new DateTime("now", new DateTimeZone('America/Bogota'));

        session_start();        
        if($_SESSION['NCONTEO'] == 'c1') {

            DB::beginTransaction();
                $det = DetalleConteos1::find($id);
                
                $det->update([
                    'Comments' => "Se agrego un producto en esta posicon con el codigo: ".$input['ItemCode'],
                    'State' => 1
                ]);
                $det = json_decode( json_encode($det),true);

                // dd($det);

                $detail = $det['Conteo_id'];

                $crearcopia = CopiaWMS::create([
                    'ItemCode' => $input['ItemCode'],
                    'Description'=> $desc,
                    'BarCode'=> $input['barcode'],
                    'Amount'=> $input['Amount'],
                    'Lote'=> $input['Lote'],
                    'DateExpiration'=> $input['Expiration'],
                    'Zone'=> $input['Zone'],
                    'Hallway'=> $input['Hallway'],
                    'Location'=> $input['Location'],
                    'New' => 'si',
                    'DateCopy' => $fecha_hora->format('Y-m-d'),
                    'HourCopy' => $fecha_hora->format('H:i:s'),
                    'State' => 1,
                ]);
                $crearcopia = json_decode( json_encode($crearcopia),true);

                $copi = $crearcopia['id'];

                $creardetalle = DetalleConteos1::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    'Comments' => "producto agregado en posicion.",
                    "ItemCode" => $input['ItemCode'],
                    "Amount"=> $input['Amount'],
                    "Lote"=> $input['Lote'],
                    "DateExpiration"=> $input['Expiration'],
                    "State" => 1,
                ]);
                
                DetalleConteos2::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
                DetalleConteos3::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
            DB::commit();
            Alert::success('Se agrego', 'se agrego el producto exitosamente.');
            return redirect()->route('Ubicaciones', [
                'id' => $detail,
                'ncount' => $_SESSION['NCONTEO'],
            ]);

        }elseif ($_SESSION['NCONTEO'] == 'c2'){     
            DB::beginTransaction();
                $det = DetalleConteos2::find($id);

                $det->update([
                    'Comments' => "Se agrego un producto en esta posicon con el codigo: ".$input['ItemCode'],
                ]);
                $det = json_decode( json_encode($det),true);

                $detail = $det['Conteo_id'];

                $crearcopia = CopiaWMS::create([
                    'ItemCode' => $input['ItemCode'],
                    'Description'=> $desc,
                    'BarCode'=> $input['barcode'],
                    'Amount'=> $input['Amount'],
                    'Lote'=> $input['Lote'],
                    'DateExpiration'=> $input['Expiration'],
                    'Zone'=> $input['Zone'],
                    'Hallway'=> $input['Hallway'],
                    'Location'=> $input['Location'],
                    'New' => 'si',
                    'DateCopy' => $fecha_hora->format('Y-m-d'),
                    'HourCopy' => $fecha_hora->format('H:i:s'),
                    'State' => 1,
                ]);
                $crearcopia = json_decode( json_encode($crearcopia),true);

                $copi = $crearcopia['id'];

                $creardetalle = DetalleConteos2::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    'Comments' => "producto agregado en posicion.",
                    "ItemCode" => $input['ItemCode'],
                    "Amount"=> $input['Amount'],
                    "Lote"=> $input['Lote'],
                    "DateExpiration"=> $input['Expiration'],
                    "State" => 1,
                ]);
                DetalleConteos1::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
                DetalleConteos3::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
            DB::commit();
            Alert::success('Se agrego', 'Se guardo y se agrego el producto exitosamente.');
            return redirect()->route('Ubicaciones', [
                'id' => $detail,
                'ncount' => $_SESSION['NCONTEO'],
            ]);


        }elseif ($_SESSION['NCONTEO'] == 'c3') {  
   
            DB::beginTransaction();
                $det = DetalleConteos3::find($id);

                $det->update([
                    'Comments' => "Se agrego un producto en esta posicon con el codigo: ".$input['ItemCode'],
                ]);
                $det = json_decode( json_encode($det),true);

                $detail = $det['Conteo_id'];

                $crearcopia = CopiaWMS::create([
                    'ItemCode' => $input['ItemCode'],
                    'Description'=> $desc,
                    'BarCode'=> $input['barcode'],
                    'Amount'=> $input['Amount'],
                    'Lote'=> $input['Lote'],
                    'DateExpiration'=> $input['Expiration'],
                    'Zone'=> $input['Zone'],
                    'Hallway'=> $input['Hallway'],
                    'Location'=> $input['Location'],
                    'New' => 'si',
                    'DateCopy' => $fecha_hora->format('Y-m-d'),
                    'HourCopy' => $fecha_hora->format('H:i:s'),
                    'State' => 1,
                ]);
                $crearcopia = json_decode( json_encode($crearcopia),true);

                $copi = $crearcopia['id'];

                $creardetalle = DetalleConteos3::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    'Comments' => "producto agregado en posicion.",
                    "ItemCode" => $input['ItemCode'],
                    "Amount"=> $input['Amount'],
                    "Lote"=> $input['Lote'],
                    "DateExpiration"=> $input['Expiration'],
                    "State" => 1,
                ]);
                
                DetalleConteos2::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
                DetalleConteos1::create([
                    "Conteo_id" => $detail,
                    "Copia_id" => $copi,
                    "State" => 0,
                ]);
            DB::commit();
            Alert::success('Se agrego', 'Se guardo y se agrego el producto exitosamente.');
            return redirect()->route('Ubicaciones', [
                'id' => $detail,
                'ncount' => $_SESSION['NCONTEO'],
            ]);

        }
    }
}
