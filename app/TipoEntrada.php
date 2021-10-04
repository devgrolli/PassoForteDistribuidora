<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEntrada extends Model{
    protected $table = "tipo_entradas"; 
    protected $fillable = ['nome', 'descricao']; 

    public function entradas(){
        return $this->hasMany("App\Entrada");
    }
}
