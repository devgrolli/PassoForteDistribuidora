<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model{
    protected $table = "pedidos"; 
    protected $fillable = ['produto','quantidade','fornecedor_id']; 

    public function fornecedor(){
        return $this->belongsTo("App\Fornecedor"); 
    }
}
