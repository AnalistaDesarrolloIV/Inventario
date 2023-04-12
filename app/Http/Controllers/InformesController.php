<?php

namespace App\Http\Controllers;

use App\Models\Conteos;
use App\Models\ModelosRecuento;
use App\Models\User;
use DateTime;
use DateTimeZone;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'ValidarRol']);
    }

    public function index()
    {

        $fecha_hora = new DateTime("now", new DateTimeZone('America/Bogota'));

        $informe = DB::select('
            SELECT 
            *
            FROM [dbo].[INFORMES_INVENTARIO]
        ');

        $informe = json_decode( json_encode( $informe),true);

        return view('pages.administrador.stractWMS.Informes', compact('informe'));
    }

    public function export(Request $request)
    {
        $form = $request->all();
        $fecha =  $form['F_Informe'];

        $informe = DB::select("
            SELECT 
            *
            FROM INFORMES_INVENTARIO 
            WHERE Fecha = '".$fecha."'
        ");

        $informe = json_decode( json_encode( $informe),true);

        if ($informe !== []) {
            return view('pages.administrador.excel.Export', compact('informe', 'fecha'));
        }else {

            Alert::warning('Informe', 'No hay informe por descarar de la fecha seleccionada.');
            return redirect()->route('informes');
        }

    }
}
