<?php

namespace App\Http\Controllers;
use App\Saida;
use App\Cliente;
use App\Entrada;
use App\Produto;
use App\TipoEntrada;
use App\TipoSaida;
use DB;
use Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function index() {
        $total_clientes = DB::table('clientes')->count();
        $total_produtos = DB::table('produtos')->count();
        $total_entradas = DB::table('entradas')->count();
        $total_saidas = DB::table('saidas')->count();

        $estoque_baixo = DashboardController::produtosEstoqueBaixo();
        $saldo_saida = DashboardController::totalSaidas();
        $saldo_entrada = DashboardController::totalEntradas();
        $caixa = DashboardController::totalCaixa();
        $data_expirada = DashboardController::validadeExpirada();

        return view('dashboard.index', compact(
            'total_clientes', 
            'total_produtos', 
            'total_entradas', 
            'total_saidas', 
            'saldo_entrada', 
            'saldo_saida',
            'estoque_baixo', 
            'caixa',
            'data_expirada'
        ));
	}

    public function totalCaixa(){
        $get_saidas = DB::table('saidas')->get();
        $saldo_saida = 0;
        foreach($get_saidas as $get){
            $find_id_saidas = DB::table('tipo_saidas')->where('id', '=', $get->tipo_saidas_id)->get()->first();
            if(($find_id_saidas->nome != 'Ajuste de Estoque') && ($find_id_saidas->nome != 'Bonificação')){
                $acum = $get->preco_un * $get->quantidade;
                $saldo_saida += $acum;
            }
        }

        $get_entradas = DB::table('entradas')->get();
        $saldo_entrada = 0;
        foreach($get_entradas as $get){
            $find_id_entrada = DB::table('tipo_entradas')->where('id', '=', $get->tipo_entrada_id)->get()->first();
            if(($find_id_entrada->nome != 'Devolução de cliente') && ($find_id_entrada->nome != 'Ajuste de estoque')){    
                $acum = $get->preco_un * $get->quantidade;
                $saldo_entrada = $saldo_entrada + $acum;
            }
        }

        $caixa = $saldo_entrada > $saldo_saida ? [$saldo_entrada - $saldo_saida, 'prejuízo'] : $saldo_saida - $saldo_entrada;
        return $caixa;
    }

    public function validadeExpirada(){
        $data_atual = Carbon\Carbon::now()->format('Y-m-d');
        $entradas_validate = DB::table('entradas')->join('produtos', 'entradas.produto_id', '=', 'produtos.id')
                                                  ->where('entradas.validade', '<', $data_atual)
                                                  ->select('produtos.nome', 'produtos.quantidade', 'entradas.validade')
                                                  ->get();
        return [$entradas_validate, $entradas_validate->count()];                                                  
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
        $prods_eb = DB::table('produtos')->where('quantidade', '<', 2)->get();
        $qtd_eb  = $prods_eb->count();
        return [$prods_eb, $qtd_eb];
    }
}

