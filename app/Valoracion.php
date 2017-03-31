<?php

namespace pruebaNivel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Valoracion extends Model
{
    //
    protected $table = 'valoraciones';
    protected $fillable = ['usuario_id', 'pelicula_id'];

    protected $rules = ['puntuacion' => 'integer|min:0'];

    public function validate($data)
    {
        return Validator::make($data, $this->rules);

    }


}