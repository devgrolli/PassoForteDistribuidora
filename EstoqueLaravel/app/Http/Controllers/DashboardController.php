<?php

namespace App\Http\Controllers;
use DB;
use Carbon;
class DashboardController extends Controller{
    public function index() {
        $total_clientes = DB::table('clientes')->count();
        $total_produtos = DB::table('produtos')->count();
        $total_entradas = DB::table('entradas')->where('deleted_at', '=', false)->count();
        $total_saidas = DB::table('saidas')->where('deleted_at', '=', false)->count();

        $estoque_baixo = DashboardController::produtosEstoqueBaixo();
        $saldo_saida = DashboardController::totalSaidas();
        $saldo_entrada = DashboardController::totalEntradas();
        $balanco_caixa = DashboardController::calulaBalancoCaixa();
        $data_expirada = DashboardController::validadeExpirada();

        return view('dashboard.index', compact(
            'total_clientes', 
            'total_produtos', 
            'total_entradas', 
            'total_saidas', 
            'saldo_entrada',
            'balanco_caixa',
            'saldo_saida',
            'estoque_baixo', 
            'data_expirada'
        ));
	}

    public function calulaBalancoCaixa(){
        $valor_prejuizo = 0;
        $valor_lucro = 0;
        $table_saidas_prejuizo = [];
        $table_saidas_lucro = [];

        $calcula_prejuizo = DB::table('saidas')->where('deleted_at', '=', false)->get();
        foreach($calcula_prejuizo as $cal){
            $find_id_saidas = DB::table('tipo_saidas')->where('id', '=', $cal->tipo_saidas_id)->get()->first();

            #Transforma valores de String para Float
            $cal->preco_un = floatval($cal->preco_un);
            $cal->preco_saida = floatval($cal->preco_saida);

            if(($find_id_saidas->nome != 'Venda') || ($find_id_saidas->nome != 'Devolução ao Fornecedor') && ($cal->preco_un > $cal->preco_saida)){

                #Calcula o valor do Prejuizo do preço de entrada
                $prejuizo = $cal->preco_un - $cal->preco_saida;

                #Passa o valor total do prejuizo pra dentro do objeto que será usado na view
                $cal->valor_total_saida = $cal->preco_saida * $cal->quantidade; 

                #Passa o valor total do prejuizo pra dentro do objeto que será usado na view
                $cal->valor_desconto = $prejuizo * $cal->quantidade;

                #Calcula a porcentagem de Prejuizo
                $porcentagem = $prejuizo / $cal->preco_un * 100;
                $cal->procentagem = intval($porcentagem);

                #Recebe o valor total do prejuizo vezes a quantidade e joga para dentro do array que será usado na view
                $valor_prejuizo += $prejuizo * $cal->quantidade;
                array_push($table_saidas_prejuizo, $cal);

            }else{
                #Calcula o valor do lucro sobre o preço de entrada
                $lucro = $cal->preco_saida - $cal->preco_un;

                #Passa o valor total do lucro pra dentro do objeto que será usado na view
                $cal->valor_total_saida = $cal->preco_saida * $cal->quantidade;

                #Passa o valor total do lucro pra dentro do objeto que será usado na view
                $cal->valor_desconto = $lucro * $cal->quantidade;

                #Calcula a porcentagem de lucro
                $porcentagem = $lucro / $cal->preco_un * 100;
                $cal->procentagem = intval($porcentagem);


                #Recebe o valor total do lucro vezes a quantidade e joga para dentro do array que será usado na view
                $valor_lucro += $lucro * $cal->quantidade;
                array_push($table_saidas_lucro, $cal);
            }
        }
        $calulos_prejuizo = $valor_prejuizo == 0 ? $valor_prejuizo : [$valor_prejuizo, $table_saidas_prejuizo];
        $calulos_lucro = $valor_lucro == 0 ? $valor_lucro : [$valor_lucro, $table_saidas_lucro];

        return [$calulos_prejuizo, $calulos_lucro];
    }

    public function validadeExpirada(){
        $data_atual = Carbon\Carbon::now()->format('Y-m-d');
        $entradas_validate = DB::table('entradas')->select('produtos.nome', 'produtos.quantidade', 'entradas.validade')
                                                  ->join('produtos', 'entradas.produto_id', '=', 'produtos.id')
                                                  ->where('entradas.validade', '<', $data_atual)
                                                  ->where('deleted_at', '=', false)
                                                  ->select('produtos.nome', 'produtos.quantidade', 'entradas.validade')->get();
        return [$entradas_validate, $entradas_validate->count()];                                                  
    }

    public function totalEntradas(){
        $produtos = DB::table('entradas')->select('quantidade', 'preco_un')->where('deleted_at', '=', false)->get();
        $qtd_entrada = $produtos->sum('quantidade');
        $preco_entrada = $produtos->sum('preco_un');
        $saldo_ent = $preco_entrada * $qtd_entrada; 
        return $saldo_ent;
    }

    public function totalSaidas(){
        $saidas = DB::table('saidas')->select('quantidade', 'preco_un')->where('deleted_at', '=', false)->get();
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

