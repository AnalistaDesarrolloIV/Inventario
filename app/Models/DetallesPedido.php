<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesPedido extends Model
{
    use HasFactory;
    
    public $table = 'DetallesPedido';
    protected $primaryKey = 'id';
    protected $fillable = [
        'PEDIDO_ID',
        'CODIGO_ARTICULO',
        'DESCRIPCION_ARTICULO',
        'LOTE',
        'CANTIDAD',
        'ESTADO',
        'OPERADOR_QUE_EJECUTA',
        'NOMBRE_BAHIA',
        'NOMBRE_PASILLO',
        'UBICACION',
        'COMPARTIMENTO',
        'CODIGO_BARRAS',
        'ESTADO_ID',
    ];
    public $timestamps = true;

    public function Est_line(){
        return $this->hasOne('App\Models\EstadosPedido', 'id', 'ESTADO_ID');
    }
}
