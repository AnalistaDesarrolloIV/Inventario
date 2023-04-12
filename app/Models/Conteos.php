<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteos extends Model
{
    use HasFactory;

    public $table = 'Conteos';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'Model_id',
        'User1',
        'User2',
        'User3',
        'Difference',
        'DateAsign',
        'State1',
        'State2',
        'State3',
    ];
    
    public $timestamps = true;
}
