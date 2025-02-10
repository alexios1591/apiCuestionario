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

    protected $appends = ['NomComp'];
    public function getNomCompAttribute()
    {
        return $this->NomClie . ' ' . $this->AppClie . ' ' . $this->ApmClie;
    }

    public function preguntas()
    {
        return $this->hasMany(Cuestionario::class, 'CodClie', 'CodClie');
    }

}
