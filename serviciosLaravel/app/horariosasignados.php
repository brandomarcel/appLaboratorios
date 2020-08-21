<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class horariosasignados extends Model
{
    public $timestamps = false; //no aparesca el actualizado insertado y eso
    protected $table = 'horariosasignados';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
