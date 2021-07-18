<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidosDados extends Model{
    protected $table = "pedidos_dados";
    protected $fillable = ['produto','quantidade']; 
}
