<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestroObras extends Model
{
    //
    protected $table = 'maestrosobras';

    protected $fillable=['nombre','num_documento','direccion','telefono','email'];
}
