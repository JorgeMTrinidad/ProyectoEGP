<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    //
 //
 protected $table = 'detalle_ingresos';
 protected $fillable = [
     'idingreso',
     'idproducto',
     'cantidad',
     'precio',
     'estado'

 ];

 public $timestamps = false;
}

