<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $table = "clientes"; 
    protected $fillable = ['nome', 'email', 'telefone', 'descricao', 'tipo_cliente_id']; 

    public function tipo_cliente(){
        return $this->belongsTo("App\TipoCliente"); //
    }
}
