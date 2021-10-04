<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model{
    protected $table = "entradas"; 
    protected $fillable = [
        'produto_id', 
        'quantidade', 
        'preco_un',
        'validade', 
        'fornecedor_id', 
        'tipo_entrada_id', 
        'observacoes',
        'status_preco'
    ]; 

    public function produto(){
        return $this->belongsTo("App\Produto"); 
    }

    public function fornecedor(){
        return $this->belongsTo("App\Fornecedor"); 
    }

    public function tipo_entrada(){
        return $this->belongsTo("App\TipoEntrada"); 
    }
}
