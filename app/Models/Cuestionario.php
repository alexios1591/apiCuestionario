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
        'FecPre',
        'HorPre'
    ];
    public $timestamps = false;
    protected $primaryKey = 'CodPre';

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->PunPre =
                $model->Pre1 +
                $model->Pre2 +
                $model->Pre3 +
                $model->Pre4 +
                $model->Pre5 +
                $model->Pre6 +
                $model->Pre7 +
                $model->Pre8 +
                $model->Pre9 +
                $model->Pre10 +
                $model->Pre11;
        });
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'CodClie', 'CodClie');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'CodUsu', 'CodUsu');
    }

}
