<?php

namespace App\Http\Controllers;
use App\Saida;
use App\Cliente;
use App\Entrada;
use App\Produto;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function index() {

        $total_clientes = DB::table('clientes')->count();
        $total_produtos = DB::table('produtos')->count();
        $total_entradas = DB::table('entradas')->count();
        $total_saidas = DB::table('saidas')->count();


        #Calcula o Estoque baixo 
        $estoque_baixo = DB::table('produtos')->where('quantidade', '<', 5)->get();
        $qtd_estoque_baixo = $estoque_baixo->count();


        #Calcula o valor total de entradas
        $produtos = DB::table('entradas')->select('quantidade', 'preco_un')->get();
        $qtd_entrada = $produtos->sum('quantidade');
        $preco_entrada = $produtos->sum('preco_un');
        $saldo_entrada = $preco_entrada * $qtd_entrada; 

        #Calcula o valor total de saidas
        $saidas = DB::table('saidas')->select('quantidade', 'preco_un')->get();
        $quantidade_saida = $saidas->sum('quantidade');
        $preco_saida = $saidas->sum('preco_un');
        $saldo_saida = $preco_saida * $quantidade_saida; 

        #Total do caixa
        $caixa = $saldo_entrada - $saldo_saida;

        
        return view('dashboard.index', compact('total_clientes', 
                        'total_produtos', 
                        'total_entradas', 
                        'total_saidas', 
                        'saldo_entrada', 
                        'saldo_saida',
                        'estoque_baixo',
                        'qtd_estoque_baixo', 
                        'caixa'));

        // return view('dashboard.index')
        //     ->with('var1', $var1->count())
        //     ->with('var2', $var2->count())
        //     ->with('saldo_entrada', $saldo_entrada)
        //     ->with('saldo_saida', $saldo_saida)
        //     ->with('var3', $var3->count())
        //     ->with('var4', $var4->count())
        //     ->with('caixa', $caixa)
        //     ->with('estoque_baixo', $estoque_baixo);
	}
}

