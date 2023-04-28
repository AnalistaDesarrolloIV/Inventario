<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosPedido extends Model
{
    use HasFactory;
    public $table = 'EstadosPedido';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Nombre',
    ];
    public $timestamps = true;
}
