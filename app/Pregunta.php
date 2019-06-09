<?php

namespace BiometriaIEE;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public function cuestionario(){
        return $this->belongsTo('BiometriaIEE\Cuestionario');
    }
}
