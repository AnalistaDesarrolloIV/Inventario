<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleConteos1 extends Model
{
    use HasFactory;
    public $table = 'DetalleConteos1';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'Conteo_id',
        'Copia_id',
        'Comments',
        'Amount',
        'Lote',
        'DateExpiration',
        'State',
    ];
    
    public $timestamps = true;
}
