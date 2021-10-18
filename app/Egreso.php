<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    // falta ag
    protected $table = 'egresos';
    protected $fillable =[
        'idcliente',
        'idusuario',
        'tipo_identificacion',
        'num_egreso',
        'fecha_egreso',
        'subtotal',
        'total',
        'total_costos',
        'estado'
    ];
}



