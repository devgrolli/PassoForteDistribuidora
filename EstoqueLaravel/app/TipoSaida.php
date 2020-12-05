<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSaida extends Model{
    protected $table = "tipo_saidas"; 
    protected $fillable = ['nome', 'descricao']; 

    public function saidas(){
        return $this->hasMany("App\Saida");
    }
}
