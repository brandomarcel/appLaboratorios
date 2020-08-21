<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registro extends Model
{
    //
    public $timestamps = false;
    protected $table = 'registro';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
