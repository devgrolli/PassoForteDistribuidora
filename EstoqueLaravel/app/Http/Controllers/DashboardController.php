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
        $calcula_descontos = DB::table('saidas')->get();
        $valor_prejuizo = 0;
        $valor_lucro = 0;
        $table_saidas_prejuizo = [];
        $table_saidas_lucro = [];

        foreach($calcula_descontos as $cal){
            $find_id_saidas = DB::table('tipo_saidas')->where('id', '=', $cal->tipo_saidas_id)->get()->first();
            $cal->preco_un = floatval($cal->preco_un);
            $cal->preco_saida = floatval($cal->preco_saida);

            if(($find_id_saidas->nome != 'Venda') && ($find_id_saidas->nome != 'Devolução ao Fornecedor') && ($cal->preco_un > $cal->preco_saida)){
                $prejuizo = $cal->preco_un - $cal->preco_saida;
                $cal->valor_desconto = $prejuizo * $cal->quantidade;
                $valor_prejuizo += $prejuizo * $cal->quantidade;
                array_push($table_saidas_prejuizo, $cal);
            }else{
                $lucro = $cal->preco_saida - $cal->preco_un;
                $cal->valor_desconto = $lucro * $cal->quantidade;
                $valor_lucro += $lucro * $cal->quantidade;
                array_push($table_saidas_lucro, $cal);
            }
        }
        if($valor_lucro > $valor_prejuizo){
            $caixa = $valor_lucro - $valor_prejuizo;
            return [$caixa, $table_saidas_lucro, 'lucro'];
        }else{
            $caixa = $valor_prejuizo - $valor_lucro;
            return [$caixa, $table_saidas_prejuizo, 'prejuizo'];
        }
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

