<?php

namespace pruebaNivel;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $table = 'usuarios';
    protected $fillable= ['nombre', 'apellido'];


}
