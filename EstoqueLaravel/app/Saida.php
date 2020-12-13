<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model{
    protected $table = "saidas"; 
    protected $fillable = [
        'produto_id', 
        'quantidade', 
        'preco_un', 
        'data_saida', 
        'observacoes',
        'tipo_saidas_id'
    ]; 

    public function produto(){
        return $this->belongsTo("App\Produto"); 
    }

    public function tipo_saida(){
        return $this->belongsTo("App\TipoSaida"); 
    }

}
