<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $table = 'distrito';
    protected $fillable = [
        'idDistrito',
        'distrito',
        'idProvincia'
    ];

    protected $primaryKey = 'idDistrito';

    public $timestamps = false;

}
