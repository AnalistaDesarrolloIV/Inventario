<?php

namespace App\Jobs;

use App\Models\PedidoSap;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class empaque_sap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::retry(30, 5, throw: false)->post('https://10.170.20.95:50000/b1s/v1/Login',[
            'CompanyDB' => 'INVERSIONES',
            'UserName' => 'Desarrollos',
            'Password' => 'Asdf1234$',
        ])['SessionId'];
        
        $pedido = PedidoSap::all()->where('ESTADO_ID', 4);
        foreach ($pedido as $key => $value) {
            $gard = Http::retry(30, 5, throw: false)->withToken($response)->patch("https://10.170.20.95:50000/b1s/v1/DeliveryNotes(".$value->DOCUMENTO.")", [
                "U_IV_FECHEMP"=>$value->updated_at,
                "U_IV_INIEMP" => $value->HORA_INICIO_EMP,
                "U_IV_FINEMP"=> $value->HORA_FIN_EMP,
                "U_IV_FACTURADOR"=> $value->EMPACADOR
            ]);
        }
    }
}
