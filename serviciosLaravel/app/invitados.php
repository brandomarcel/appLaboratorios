<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invitados extends Model
{
    public $timestamps = false;
    protected $table = 'invitado';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
