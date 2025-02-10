<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $table = 'provincia';

    protected $fillable = [
        'idProvincia',
        'provincia',
        'idDepartamneto'
    ];

    public $timestamps = false;
    protected $primaryKey = 'idProvincia';

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'idDepartamneto', 'idDepartamneto');
    }
}
