<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    public $timestamps = false;
    protected $table = 'usuario';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
    
}