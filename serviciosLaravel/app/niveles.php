<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class niveles extends Model
{
    public $timestamps = false;
    protected $table = 'nivel';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
