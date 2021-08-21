<?php

namespace App\Http\Controllers;
use DB;
use App\Entrada;
use App\Produto;
use App\Http\Requests\EntradaRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EntradasController extends Controller{
    public function index() {
		$entradas = Entrada::orderBy('id')->where('deleted_at', '=', false)->paginate(10);
		return view('entradas.index', ['entradas'=>$entradas]);
	}

    public function create(){ 
        $products = Produto::all();
        return view('entradas.create', compact('products'));
    }

    public function store(EntradaRequest $request){
        $nova_entrada = $request->all(); 
        $estoque_produto = Produto::find($request->produto_id);

        if ($request->quantidade == 0 || $request->quantidade < 0) {
            Alert::error('Quantidade Inválida', 'Insira uma quantidade maior que zero')->persistent('Close');
            return redirect()->back()->withInput();

        }else{
            $same_date_entrada = DB::table('entradas')->where('produto_id', '=', $request->produto_id)
                                                      ->where('deleted_at', '=', false)
                                                      ->where('validade', '=', $request->validade)->get(); # verifica se o produto de entrada tem a mesma data de validade
            if ($same_date_entrada->isEmpty()){
                $nova_entrada['preco_un'] = UtilController::formataMoeda($request->preco_un);
                Entrada::create($nova_entrada);
                $estoque_produto->quantidade += $request->quantidade;
                $estoque_produto->save();
                return redirect()->route('entradas')->with('success', "Entrada cadastrada com sucesso!");
            }else{
                Alert::error('Produto já cadastro com mesma data de validade', 'Altere a entrada do produto que possui esta mesma validade')->persistent('Close');
                return redirect()->back()->withInput();
            }
        }    
    }

    public function destroy($id){
        try {
            EntradasController::atualizaEstoque($id);
            $entrada_deleted = Entrada::find($id);
            $entrada_deleted->deleted_at = true;
            $entrada_deleted->save();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function atualizaEstoque($id_destroy){
        $entrada = Entrada::find($id_destroy);
        $update_estoque = Produto::find($entrada->produto_id);
        $entrada->quantidade > $update_estoque->quantidade ? $update_estoque->quantidade = 0 : $update_estoque->quantidade -= $entrada->quantidade;
        $update_estoque->save();
    }

    public function edit(Request $request){
        $entrada = Entrada::find(\Crypt::decrypt($request->get('id')));
        return view('entradas.edit', compact('entrada'));
    }

    public function update(EntradaRequest $request, $id){
        $busca_produto = Produto::find($request->produto_id);
        if ($request->quantidade == 0){
            Alert::error('Quantidade zerada', 'Saída não realizada devido a quantidade estar zerada')->persistent('Close');
            return redirect()->back()->withInput();
         
        }else if ($busca_produto->quantidade == 0){  
            Alert::error('Produto sem estoque', "Tente outro produto")->persistent('Close');
            return redirect()->back()->withInput();
        
        }else{  
            $request['preco_un'] = UtilController::formataMoeda($request->preco_un);
            Entrada::find($id)->update($request->all());
            $busca_produto->quantidade = $request->quantidade;
            $busca_produto->save();
            return redirect()->route('entradas')->with('success', "Entrada de produto alterada com sucesso!");
        }
    }
}
