<?php

namespace BiometriaIIE;

use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
public function preguntas()
{
    return $this->hasMany('BiometriaIIE\Pregunta');
}
}
