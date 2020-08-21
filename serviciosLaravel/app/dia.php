<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dia extends Model
{
    public $timestamps = false;
    protected $table = 'dia';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
