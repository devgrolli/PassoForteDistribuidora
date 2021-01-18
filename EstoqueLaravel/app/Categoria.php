<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
    protected $table = "categorias"; 
    protected $fillable = ['nome', 'descricao']; 

    public function entradas(){
        return $this->hasMany("App\Produto");
    }
}