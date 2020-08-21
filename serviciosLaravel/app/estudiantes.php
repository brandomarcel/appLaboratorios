<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estudiantes extends Model
{
    public $timestamps = false; //no aparesca el actualizado insertado y eso
    protected $table = 'estudiante';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
