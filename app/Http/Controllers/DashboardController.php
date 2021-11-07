<?php

namespace App\Http\Controllers;
use App\Entrada;
use App\Saida;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller{
    public function index() {
        $total_clientes = DB::table('clientes')->count();
        $total_produtos = DB::table('produtos')->count();
        $total_entradas = DB::table('entradas')->where('is_excluded', '=', false)->count();
        $total_saidas = DB::table('saidas')->where('is_excluded', '=', false)->count();

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

    public static function calulaBalancoCaixa(){
        $valor_prejuizo = 0;
        $valor_lucro = 0;
        $table_saidas_prejuizo = [];
        $table_saidas_lucro = [];

        $calcula_prejuizo = DB::table('saidas')->where('is_excluded', '=', false)->get();

        $start_date = Carbon::now()->startOfMonth()->format('d/m/Y'); 
        $end_date = Carbon::now()->endOfMonth()->format('d/m/Y'); 

        foreach($calcula_prejuizo as $cal){
            $validate_dates =  Carbon::parse($cal->created_at)->format('d/m/Y');

            if(($validate_dates >= $start_date) && ($validate_dates <= $end_date)){
                $find_id_saidas = DB::table('tipo_saidas')->where('id', '=', $cal->tipo_saidas_id)->get()->first();

                #Transforma valores de String para Float
                $cal->preco_un = floatval($cal->preco_un);
                $cal->preco_saida = floatval($cal->preco_saida);

                switch ($find_id_saidas->nome) {
                    case 'Venda':
                    case 'Devolução ao Fornecedor':
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
                        break;

                    default:
                        #Calcula o valor do Prejuizo do preço de entrada
                        $prejuizo = $cal->preco_un > $cal->preco_saida ? $cal->preco_un - $cal->preco_saida : $cal->preco_saida - $cal->preco_un;
                        
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
                        break;
                }
            }
        }
        $calulos_prejuizo = $valor_prejuizo == 0 ? $valor_prejuizo : [$valor_prejuizo, $table_saidas_prejuizo];
        $calulos_lucro = $valor_lucro == 0 ? $valor_lucro : [$valor_lucro, $table_saidas_lucro];

        return [$calulos_prejuizo, $calulos_lucro];
    }

    public static function validadeExpirada(){
        $data_atual = Carbon::now()->format('Y-m-d');
        $entradas_validate = DB::table('entradas')
            ->select('produtos.nome', 'produtos.quantidade', 'entradas.validade')
            ->join('produtos', 'entradas.produto_id', '=', 'produtos.id')
            ->where('entradas.validade', '<', $data_atual)
            ->where('entradas.is_excluded', '=', false)
            ->select('produtos.nome', 'produtos.quantidade', 'entradas.validade')->get();
        return [$entradas_validate, $entradas_validate->count()];                                                  
    }

    public static function totalEntradas(){
        $produtos = DB::table('entradas')->select('quantidade', 'preco_un')->where('is_excluded', '=', false)->get();
        $qtd_entrada = $produtos->sum('quantidade');
        $preco_entrada = $produtos->sum('preco_un');
        $saldo_ent = $preco_entrada * $qtd_entrada; 
        return $saldo_ent;
    }

    public static function totalSaidas(){
        $saidas = DB::table('saidas')->select('quantidade', 'preco_un')->where('is_excluded', '=', false)->get();
        $quantidade_saida = $saidas->sum('quantidade');
        $preco_saida = $saidas->sum('preco_un');
        $saldo_s = $preco_saida * $quantidade_saida; 
        return $saldo_s;
    }

    public static function produtosEstoqueBaixo() {
        $prods_eb = DB::table('produtos')->where('quantidade', '<', 2)->where('is_excluded', '=', true)->get();
        $qtd_eb  = $prods_eb->count();
        return [$prods_eb, $qtd_eb];
    }

    public static function graficoEntrada(){
        $get_periodo = [];
        $count_entradas = [];
        $periodo = Entrada::whereBetween('validade', [Carbon::now()->subMonths(6)->format('d/m/Y'), Carbon::now()->format('d/m/Y')])->where('is_excluded', '=', false)->get();

        $month = intval(Carbon::now()->format('m'));
        $months_ago = intval(Carbon::now()->subMonths(6)->format('m'));

        for ($i = $months_ago; $i <= $month; $i++) {
            $cont = 0;
            foreach($periodo as $p){
                $validate_month = Carbon::parse($p->validade)->format('m');
                if(intval($validate_month) == $i){
                    $cont += 1;
                }
            }
            array_push($get_periodo, Carbon::now()->subMonths($month - $i)->format('m/Y'));
            array_push($count_entradas, $cont);
        }
        return [$count_entradas, $get_periodo]; 
    }

    public static function graficoSaida(){
        $get_periodo = [];
        $count_saidas = [];
        $periodo = Saida::whereBetween('created_at', [Carbon::now()->subMonths(6), Carbon::now()])->where('is_excluded', '=', false)->get();

        $month = intval(Carbon::now()->format('m'));
        $months_ago = intval(Carbon::now()->subMonths(6)->format('m'));

        for ($i = $months_ago; $i <= $month; $i++) {
            $cont = 0;
            foreach($periodo as $p){
                $validate_month = Carbon::parse($p->created_at)->format('m');
                if(intval($validate_month) == $i){
                    $cont += 1;  
                }
            }
            array_push($get_periodo, Carbon::now()->subMonths($month - $i)->format('m/Y'));
            array_push($count_saidas, $cont);
        }
        return [$count_saidas, $get_periodo]; 
    }
}

