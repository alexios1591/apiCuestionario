<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    use HasFactory;

    protected $table = 'preguntas';
    protected $fillable = [
        'CodPre',
        'CodClie',
        'CodUsu',
        'Pre1',
        'Pre2',
        'Pre3',
        'Pre4',
        'Pre5',
        'Pre6',
        'Pre7',
        'Pre8',
        'Pre9',
        'Pre10',
        'Pre11',
        'Pre12',
        'Pre13',
        'ObsPre',
        'PunPre',
    ];
    public $timestamps = false;
    protected $primaryKey = 'CodPre';
}
