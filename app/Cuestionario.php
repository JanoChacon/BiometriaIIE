<?php

namespace BiometriaIEE;

use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
public function preguntas()
{
    return $this->hasMany('BiometriaIEE\Pregunta');
}
}
