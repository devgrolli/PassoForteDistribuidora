<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model{
    protected $table = "pedidos"; 
    protected $fillable = ['data_pedido','fornecedor_id']; 

    public function fornecedor(){
        return $this->belongsTo("App\Fornecedor"); 
    }
}
