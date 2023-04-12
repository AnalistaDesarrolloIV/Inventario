<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelosRecuento extends Model
{
    use HasFactory;
    public $table = 'Modelos_recuento';

    protected $primaryKey = 'Id';
    
    protected $fillable = [
        'Model',
    ];
    
    public $timestamps = true;
}
