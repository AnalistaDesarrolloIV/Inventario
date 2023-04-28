<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoSap extends Model
{
    use HasFactory;
    public $table = 'PedidosSap';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'COD_CLIENTE',
        'NOMBRE_CLIENTE',
        'RECOLECTOR',
        'HORA_INICIO_REC',
        'HORA_FIN_REC',
        'EMPACADOR',
        'HORA_INICIO_EMP',
        'HORA_FIN_EMP',
        'PEDIDO',
        'DOCUMENTO',
        'CANT_LINEAS',
        'CANT_UNIDADES',
        'FECHA',
        'COMENTARIOS',
        'ESTADO_ID',
    ];
    
    public $timestamps = true;

    public function Estado(){
        return $this->hasOne('App\Models\EstadosPedido', 'id', 'ESTADO_ID');
    }
}
