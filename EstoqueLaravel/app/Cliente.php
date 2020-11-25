<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $table = "clientes"; 
    protected $fillable = ['nome', 'email', 'telefone', 'descricao']; 

    public function clientes(){
        return $this->hasMany("App\Cliente");
    }
}
