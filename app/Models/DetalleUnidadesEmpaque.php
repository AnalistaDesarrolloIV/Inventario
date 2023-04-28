<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleUnidadesEmpaque extends Model
{
    use HasFactory;
    public $table = 'DetalleUnidadesEmpaque';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'REFERENCIAS',
        'UNIDAD_ID',
        'CANTIDAD',
    ];
    
    public $timestamps = true;

    public function unidad(){
        return $this->hasOne('App\Models\UnidadesEmpaque', 'id', 'UNIDAD_ID');
    }
}
