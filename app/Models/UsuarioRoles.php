<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioRoles extends Model
{
    use HasFactory;
    protected $table = 'usuarios_rol';
    public $timestamps = false;
    protected $primaryKey = 'CodUR';
    protected $fillable = ['CodUsu', 'CodRol', 'EstUM', 'RegUR'];
}
