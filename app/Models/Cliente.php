<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'CodClie',
        'NomClie',
        'AppClie',
        'ApmClie',
        'EmaClie',
        'DniClie',
        'FnaClie',
        'CelClie',
        'localidad',
        'RegClie'
    ];
    public $timestamps = false;
    protected $primaryKey = 'CodClie';
}
