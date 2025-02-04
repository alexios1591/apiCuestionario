<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';
    public $timestamps = false;
    protected $primaryKey = 'CodUsu';
    protected $fillable = [
        'CodUsu',
        'NomUsu',
        'AppUsu',
        'ApmUsu',
        'DocUsu',
        'PassUsu',
        'EmaUsu',
        'CelUsu',
        'sexUsu',
        'FnaUsu',
        'RegUsu'
    ];

    protected $casts = [
        'PassUsu' => 'hashed',
    ];
}
