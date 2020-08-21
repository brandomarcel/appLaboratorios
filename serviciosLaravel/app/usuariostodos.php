<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuariostodos extends Model
{
    public $timestamps = false;
    protected $table = 'usuarios';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
