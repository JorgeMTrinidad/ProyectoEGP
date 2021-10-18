<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEgreso extends Model
{
    // ya no hay error?
    //creo que no, solo voy a verificar que se guardó en el campo de cantidad2
    //Se duplica en ambas creo, es porq les puse el mismo valor
    protected $table = 'detalle_egresos';
    protected $fillable = [
        'idegreso',
        'idproducto',
        'cantidad',  // cantidad 1
        'precio',
        'revision'
    ];

    public $timestamps = false;
}
