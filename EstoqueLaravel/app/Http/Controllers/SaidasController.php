<?php

namespace App\Http\Controllers;
use DB;
use App\Saida;
use App\Produto;
use App\Entrada;
use Lib\Collection;
use App\Http\Controllers\Response;
use App\Http\Requests\SaidaRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class SaidasController extends Controller{
    public function index() {
		$saidas = Saida::orderBy('id')->paginate(10);
		return view('saidas.index', ['saidas'=>$saidas]);
	}

    public function getprods($valor){
        $produto = Entrada::where('produto_id', '=', $valor)->get();
        return $produto->isEmpty() ? json_encode('Sem estoque') : json_encode($produto);
    }

    public function create(){
        $entradas = Entrada::all();
        $products = Produto::where('quantidade', '>', '0')->get();
        return view('saidas.create', compact('products', 'entradas'));
    }

    public function store(SaidaRequest $request){ 
        $nova_saida = $request->all();
        $estoque_produto = Produto::find($request->produto_id);
        $verifica_valor_entrada = DB::table('entradas')->where('produto_id', '=', $estoque_produto->id)->get()->first();
        $nome_tipo_saida = DB::table('tipo_saidas')->where('id', '=', $request->tipo_saidas_id)->get()->first();
        if ($request->quantidade > $estoque_produto->quantidade) {
            Alert::error("Quantidade do produto em estoque: $estoque_produto->quantidade" , 'Insira uma quantidade válida')->persistent('Close');
            return redirect()->back()->withInput();

        }else if ($request->quantidade == 0){
            Alert::error('Quantidade zerada', 'Saída não realizada devido a quantidade estar zerada')->persistent('Close');
            return redirect()->back()->withInput();

        }else if (($nome_tipo_saida->nome != 'Outras Saídas') && ($nome_tipo_saida->nome != 'Remessa') && ($nome_tipo_saida->nome != 'Ajuste de Estoque') && (floatval($request->preco_un) < floatval($verifica_valor_entrada->preco_un))){ 
            Alert::error('Valor da saída abaixo do valor de entrada', "Preço para o tipo de saída '$nome_tipo_saida->nome' está abaixo do preço de entrada, tente outro tipo ou um valor maior")->persistent('Close');
            return redirect()->back()->withInput();

        }else{
            // $compara_movi = SaidasController::comparaValidade($request);
            if ((floatval($request->preco_entrada) < (floatval($request->preco_un))) && ($nome_tipo_saida->nome == 'Venda')){
                $formatada = date('d/m/Y', strtotime($request->validade));
                Alert::error('Valor Saída maior que de Entrada', "Insira um outro tipo de saída ou um valor maior que o valor de entrada para o produto com essa validade $formatada")->persistent('Close');
                return redirect()->back()->withInput();
            }else{
                $valor = ProdutosController::formataMoeda($request->preco_un);
                $nova_saida['preco_un'] = $valor;
                Saida::create($nova_saida);
                $estoque_produto->quantidade = $estoque_produto->quantidade - $request->quantidade;
                $estoque_produto->save();
                return redirect()->route('saidas')->with('success', 'Saída cadastrada com sucesso!');
            }
        }  
    }

    public function comparaValidade($request){
        $compara_preco_movimentacoes =[];
        $check_validade = Entrada::where('produto_id', '=', $request->produto_id)->get();
        foreach($check_validade as $check){ if(date('d/m/Y', strtotime($check->validade)) == $request->validade_produto){ array_push($compara_preco_movimentacoes, $check); }}
        return $compara_preco_movimentacoes;
    }

    public function destroy($id){
        try {
            Saida::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function atualizaEstoque($id){
        $update_product = Produto::all();
        $retoma_valor = Saida::find($id)->quantidade;
        $update_product->quantidade = $retoma_valor; #retoma o valor do produto de entrada
        $update_product->save();
    }

    public function edit(Request $request){
        $products = Produto::all();
        $saida = Saida::find(\Crypt::decrypt($request->get('id')));
        return view('saidas.edit', compact('saida', 'products'));
    }

    public function update(SaidaRequest $request, $id){
        $request['preco_un'] = ProdutosController::formataMoeda($request->preco_un);
        $busca_produto = Produto::find($request->produto_id);
        if ($request->quantidade > $busca_produto->quantidade) {
            Alert::error("Quantidade em estoque: $busca_produto->quantidade" , 'Quantidade da saída do produto é maior que a quantidade em estoque!')->persistent('Close');
            return redirect()->back()->withInput();

        }else if ($request->quantidade == 0){
            Alert::error('Quantidade zerada', 'Saída não realizada devido a quantidade estar zerada')->persistent('Close');
            return redirect()->back()->withInput();
         
        }else if ($busca_produto->quantidade == 0){  
            Alert::error('Produto sem estoque', "Tente outro produto")->persistent('Close');
            return redirect()->back()->withInput();
        
        }else{
            Saida::find($id)->update($request->all());
            $busca_produto->quantidade = $busca_produto->quantidade - $request->quantidade;
            $busca_produto->save();
            return redirect()->route('saidas')->with('success', "Saída alterada com sucesso!");
        }
    }
}