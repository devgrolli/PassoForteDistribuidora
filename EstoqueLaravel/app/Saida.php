<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model{
    protected $table = "saidas"; 
    protected $fillable = [
        'produto_id', 
        'quantidade', 
        'preco_un', 
        'tipo_saidas_id',
        'validade_produto',
        'observacoes'
    ]; 

    public function produto(){
        return $this->belongsTo("App\Produto"); 
    }

    public function tipo_saida(){
        return $this->belongsTo("App\TipoSaida"); 
    }

}
