<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $table = "clientes"; 
    protected $fillable = ['nome', 'email', 'telefone', 'endereco', 'categoria_cliente'=> 1, 'tipo_cliente_id', 'descricao']; 

    public function tipo_cliente(){
        return $this->belongsTo("App\TipoCliente"); //
    }
}
