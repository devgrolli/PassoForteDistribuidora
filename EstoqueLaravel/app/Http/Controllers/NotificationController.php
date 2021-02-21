<?php

namespace App\Http\Controllers;

use DB;
use Carbon;
use App\Saida;
use App\Cliente;
use App\Entrada;
use App\Produto;
use Illuminate\Http\Request;

class NotificationController extends Controller{

    public function retornoNotificacoes(){
        $notification_cliente = DB::table('clientes')->count();
        $notification_produtos = DB::table('produtos')->count();
        $notification_entradas = DB::table('entradas')->count();
        $notification_saidas = DB::table('saidas')->count();

        return compact(
            'total_clientes', 
            'total_produtos', 
            'total_entradas', 
            'total_saidas', 
            'saldo_entrada', 
            'saldo_saida',
            'estoque_baixo', 
            'caixa'
        );
    }
}
