<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    public $table = 'Roles';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Rol',
    ];
    public $timestamps = true;
}
