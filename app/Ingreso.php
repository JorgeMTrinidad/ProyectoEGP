<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //
    protected $table = 'ingresos';

    protected $fillable = [
        'idproveedor',
        'idusuario',
        'tipo_identificacion',
        'num_ingreso',
        'fecha_ingreso',
        'impuesto',
        'total',
        'revision'
    ];

    /*es el usuario que hace el registro*/
 public function usuario()
 {
     return $this->belongsTo('App\User');
 }

 /*el proveedor que hace la compra*/
 public function proveedor()
 {
     return $this->belongsTo('App\Proveedor');
 }
}
