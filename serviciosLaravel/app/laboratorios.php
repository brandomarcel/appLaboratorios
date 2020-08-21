<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laboratorios extends Model
{
    public $timestamps = false;
    protected $table = 'laboratorio';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
