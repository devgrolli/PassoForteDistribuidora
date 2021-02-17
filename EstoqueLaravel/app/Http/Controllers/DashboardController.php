<?php

namespace App\Http\Controllers;
use App\Saida;
use App\Cliente;
use App\Entrada;
use App\Produto;
use DB;
use Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function index() {
        $total_clientes = DB::table('clientes')->count();
        $total_produtos = DB::table('produtos')->count();
        $total_entradas = DB::table('entradas')->count();
        $total_saidas = DB::table('saidas')->count();

        DashboardController::validadeExpirada();
        $estoque_baixo = DashboardController::produtosEstoqueBaixo();
        $saldo_entrada = DashboardController::totalEntradas();
        $saldo_saida = DashboardController::totalSaidas();

        #Total do caixa
        $caixa = $saldo_saida - $saldo_entrada;

        return view('dashboard.index', compact(
            'total_clientes', 
            'total_produtos', 
            'total_entradas', 
            'total_saidas', 
            'saldo_entrada', 
            'saldo_saida',
            'estoque_baixo', 
            'caixa'
        ));
	}

    public function validadeExpirada(){
        $data_atual = Carbon\Carbon::now()->format('d-m-Y');
        $entradas_validate = DB::table('entradas');
        // dd($entrada_data); 
        // $validade_produto = $entrada_data->validade;
    }

    public function totalEntradas(){
        $produtos = DB::table('entradas')->select('quantidade', 'preco_un')->get();
        $qtd_entrada = $produtos->sum('quantidade');
        $preco_entrada = $produtos->sum('preco_un');
        $saldo_ent = $preco_entrada * $qtd_entrada; 
        return $saldo_ent;
    }

    public function totalSaidas(){
        $saidas = DB::table('saidas')->select('quantidade', 'preco_un')->get();
        $quantidade_saida = $saidas->sum('quantidade');
        $preco_saida = $saidas->sum('preco_un');
        $saldo_s = $preco_saida * $quantidade_saida; 
        return $saldo_s;
    }

    public function produtosEstoqueBaixo() {
        $prods_eb = DB::table('produtos')->where('quantidade', '<', 5)->get();
        $qtd_eb  = $prods_eb->count();
        return [$prods_eb, $qtd_eb];
    }
}

