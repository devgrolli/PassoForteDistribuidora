<?php

namespace App\Http\Controllers;
use App\Entrada;
use App\Produto;
use App\Http\Requests\EntradaRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EntradasController extends Controller{
    public function index() {
		$entradas = Entrada::orderBy('id')->paginate(10);
		return view('entradas.index', ['entradas'=>$entradas]);
	}

    public function create(){ 
        $products = Produto::all();
        return view('entradas.create', compact('products'));
    }

    public function store(EntradaRequest $request){ 
        $nova_entrada = $request->all(); 
        $estoque_produto = Produto::find($request->produto_id);
        if ($request->quantidade == 0) {
            Alert::error('Quantidade zera', 'Insira uma quantidade maior que zero');
            return redirect()->back()->withInput();
        }else{
            $valor = ProdutosController::formataMoeda($request->preco_un);
            $nova_entrada['preco_un'] = $valor;
            Entrada::create($nova_entrada);
            $estoque_produto->quantidade = $estoque_produto->quantidade + $request->quantidade;
            $estoque_produto->save();
            return redirect()->route('entradas')->with('success', "Entrada cadastrada com sucesso!");
        }    
    }

    public function destroy($id){

        try {
            Entrada::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit(Request $request){
        $entrada = Entrada::find(\Crypt::decrypt($request->get('id')));
        return view('entradas.edit', compact('entrada'));
    }

    // public function update(EntradaRequest $request, $id){
    //     Entrada::find($id)->update($request->all());
    //     $busca_produto = Produto::find($request->produto_id);
    //     $busca_produto->quantidade = $request->quantidade;
    //     $busca_produto->save();
    //     return redirect()->route('entradas')->with('success', "Entrada editada com sucesso!");
    // }

    public function update(EntradaRequest $request, $id){
        $busca_produto = Produto::find($request->produto_id);
        if ($request->quantidade == 0){
            Alert::error('Quantidade zerada', 'Saída não realizada devido a quantidade estar zerada');
            return redirect()->back()->withInput();
         
        }else if ($busca_produto->quantidade == 0){  
            Alert::error('Produto sem estoque', "Tente outro produto");
            return redirect()->back()->withInput();
        
        }else{
            Entrada::find($id)->update($request->all());
            $busca_produto->quantidade = $request->quantidade;
            $busca_produto->save();
            return redirect()->route('entradas')->with('success', "Entrada de produto alterada com sucesso!");
        }
    }
}
