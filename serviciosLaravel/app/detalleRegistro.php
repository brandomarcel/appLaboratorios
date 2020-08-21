<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalleRegistro extends Model
{
    public $timestamps = false;
    protected $table = 'detalleregistro';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
