<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $fillable = [
        'idDepartamento',
        'departamento',
        'idPais'
    ];

    protected $primaryKey = 'idDepartamento';

    public $timestamps = false;
}
