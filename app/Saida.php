<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model{
    protected $table = "saidas"; 
    protected $fillable = [
        'produto_id',
        'validade_produto',
        'preco_un',
        'preco_saida',
        'quantidade',
        'tipo_saidas_id',
        'observacoes'
    ]; 

    public function produto(){
        return $this->belongsTo("App\Produto"); 
    }

    public function tipo_saidas(){
        return $this->belongsTo("App\TipoSaida"); 
    }

}
