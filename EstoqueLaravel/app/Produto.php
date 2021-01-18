<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model{
    protected $table = "produtos"; 
    protected $fillable = ['nome', 'quantidade'=> 0, 'marca', 'categorias_id']; 

    public function entradas(){
        return $this->hasMany("App\Entrada");
    }

    public function categorias(){
        return $this->belongsTo("App\Categoria"); //
    }
}
