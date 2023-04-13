<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopiaWMS extends Model
{
    use HasFactory;
    public $table = 'CopiaWMS';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'ItemCode',
        'Description',
        'BarCode',
        'Amount',
        'Lote',
        'DateExpiration',
        'Zone',
        'Hallway',
        'Location',
        'Compartment',
        'New',
        'DateCopy',
        'State',
        'Type',
    ];
    
    public $timestamps = true;
}
