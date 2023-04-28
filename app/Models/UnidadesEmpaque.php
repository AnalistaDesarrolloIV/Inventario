<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadesEmpaque extends Model
{
    use HasFactory;
    
    public $table = 'UnidadesEmpaque';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'NOMBRE',
    ];
    
    public $timestamps = true;
    
}
