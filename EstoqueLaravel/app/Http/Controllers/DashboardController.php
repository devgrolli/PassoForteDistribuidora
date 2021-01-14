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

        $var1 = Cliente::orderBy('id');
        $var2 = Produto::orderBy('id');
        $var3 = Entrada::orderBy('id');
        $var4 = Saida::orderBy('id');

        $qtd_entrada = DB::table("entradas")->sum('quantidade');
        $val_entrada = DB::table("entradas")->sum('preco_un');
        
        $saldo_entrada = $val_entrada * $qtd_entrada; 

        $qtd_saida = DB::table("saidas")->sum('quantidade');
        $val_saida = DB::table("saidas")->sum('preco_un');

        $saldo_saida = $val_saida * $qtd_saida; 
        
        $caixa = $saldo_entrada - $saldo_saida;
    //     $registro = Entrada::with([ 'entradas', 'quantidade'] )->select( DB::raw('sum( quantidade ) as qtd') );

    //     dd($registro);
    
        return view('dashboard.index')
            ->with('var1', $var1->count())
            ->with('var2', $var2->count())
            ->with('saldo_entrada', $saldo_entrada)
            ->with('saldo_saida', $saldo_saida)
            ->with('var3', $var3->count())
            ->with('var4', $var4->count())
            ->with('caixa', $caixa);
	}
}

