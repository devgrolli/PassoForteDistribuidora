<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model{
    protected $table = "fornecedores"; 
    protected $fillable = [
        'cnpj', 
        'razao_social', 
        'email', 
        'cep', 
        'endereco', 
        'numero', 
        'complemento', 
        'bairro', 
        'cidade', 
        'estado', 
        'telefone'
    ]; 

    public function entradas(){
        return $this->hasMany("App\Entrada");
    }
}
