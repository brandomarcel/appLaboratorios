<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materias extends Model
{
    public $timestamps = false;
    protected $table = 'materia';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
