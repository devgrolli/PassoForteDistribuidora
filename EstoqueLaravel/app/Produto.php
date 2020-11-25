<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model{
    protected $table = "produtos"; 
    protected $fillable = ['nome', 'preco_un', 'quantidade', 'marca']; 

    public function produto(){
        return $this->hasMany("App\Produto");
    }
}
