<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoLaboratorios extends Model
{
    public $timestamps = false;
    protected $table = 'tipoLaboratorio';
    protected $casts = [ 
        //'activo' => 'bool',
    ];
}
