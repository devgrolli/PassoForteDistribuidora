<?php

namespace App\Http\Controllers;
use App\Saida;
use App\Produto;
use App\Entrada;
use App\Http\Requests\SaidaRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class SaidasController extends Controller{
    public function index() {
		$saidas = Saida::orderBy('id')->where('is_excluded', '=', false)->paginate(10);
		return view('saidas.index', ['saidas'=>$saidas]);
	}

    public static function getprods($valor){
        $produto = Entrada::where('produto_id', '=', $valor)->where('is_excluded', '=', false)->get();
        return $produto->isEmpty() ? json_encode('Sem estoque') : json_encode($produto);
    }

    public function create(){
        $entradas = Entrada::all();
        $products = Produto::where('quantidade', '>', '0')->get();
        return view('saidas.create', compact('products', 'entradas'));
    }

    public function venda(){
        $entradas = Entrada::all();
        $products = Produto::where('quantidade', '>', '0')->get();
        return view('saidas.venda', compact('products', 'entradas'));
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

        }else if ((floatval($request->preco_un) >= floatval($request->preco_saida)) && (mb_strtoupper($nome_tipo_saida->nome, 'UTF-8') == 'VENDA')){
            Alert::error('Valor Saída maior que de Entrada', "Insira um outro tipo de saída ou um valor maior/igual que o valor de entrada para o produto com essa validade $request->validade_produto")->persistent('Close');
            return redirect()->back()->withInput();

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
        $retoma_valor = Saida::find($id);
        $retoma_valor->is_excluded = true;
        $retoma_valor->deleted_at = date('d/m/Y H:i:s', time());
        $retoma_valor->save();

        $update_product = Produto::find($retoma_valor->produto_id);
        $update_product->quantidade += $retoma_valor->quantidade; #retoma o valor do produto de entrada
        $return = $update_product->save();

        return $return == true ? array('status'=>200, 'msg'=>"null") : array('status'=>501, 'msg'=>'Ocorreu um erro ao excluir a saída do produto, contate o suporte!');
    }

    public function edit(Request $request){
        $products = Produto::where('quantidade', '>', '0')->get();
        $saida = Saida::find(Crypt::decrypt($request->get('id')));
        return view('saidas.edit', compact('saida', 'products'));
    }

    public function update(SaidaRequest $request, $id){
        $request['preco_un'] = UtilController::formataMoeda($request->preco_un);
        $request['preco_saida'] = UtilController::formataMoeda($request->preco_saida);

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
    
    public function dynamic_venda($valor){
        $saidas_products = Entrada::where('produto_id', '=', $valor)->where('is_excluded', '=', false)->get();
        $all_prods = ProdutosController::get_all_products();
        return json_encode([$saidas_products, $all_prods]); 
    }
}