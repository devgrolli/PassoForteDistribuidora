<?php

namespace App\Http\Controllers;
use DB;
use App\Saida;
use App\Produto;
use App\Entrada;
use App\Http\Requests\SaidaRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

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
        $nome_tipo_saida = DB::table('tipo_saidas')->where('id', '=', $request->tipo_saidas_id)->get()->first();

        if ($request->quantidade > $estoque_produto->quantidade) {
            Alert::error("Quantidade do produto em estoque: $estoque_produto->quantidade" , 'Insira uma quantidade válida')->persistent('Close');
            return redirect()->back()->withInput();

        }else if ($request->quantidade == 0){
            Alert::error('Quantidade zerada', 'Saída não realizada devido a quantidade estar zerada')->persistent('Close');
            return redirect()->back()->withInput();

        // }else if ((floatval($request->preco_un) >= floatval($request->preco_saida)) && (mb_strtoupper($nome_tipo_saida->nome, 'UTF-8') == 'VENDA')){
        //     Alert::error('Valor Saída maior que de Entrada', "Insira um outro tipo de saída ou um valor maior/igual que o valor de entrada para o produto com essa validade $request->validade_produto")->persistent('Close');
        //     return redirect()->back()->withInput();

        }else{
            $nova_saida['preco_saida'] = UtilController::formataMoeda($request->preco_saida);
            $nova_saida['preco_un'] = UtilController::formataMoeda($request->preco_un);
            Saida::create($nova_saida);
            $estoque_produto->quantidade -= $request->quantidade;
            $estoque_produto->save();
            return redirect()->route('saidas')->with('success', 'Saída cadastrada com sucesso!');
        }
    }

    public function destroy($id){
        try {
            SaidasController::atualizaEstoque($id);
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
        $retoma_valor = Saida::find($id);
        $update_product = Produto::find($retoma_valor->produto_id);
        $update_product->quantidade += $retoma_valor->quantidade; #retoma o valor do produto de entrada
        $update_product->save();
    }

    public function edit(Request $request){
        $products = Produto::where('quantidade', '>', '0')->get();
        $saida = Saida::find(\Crypt::decrypt($request->get('id')));
        return view('saidas.edit', compact('saida', 'products'));
    }

    public function update(SaidaRequest $request, $id){
        $request['preco_un'] = UtilController::formataMoeda($request->preco_un);
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