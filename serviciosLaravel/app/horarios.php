<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class horarios extends Model
{
    public $timestamps = false; //no aparesca el actualizado insertado y eso
    protected $table = 'horarios';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
