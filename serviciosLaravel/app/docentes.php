<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docentes extends Model
{
    public $timestamps = false;
    protected $table = 'docente';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
