<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Produto;
use App\Http\Requests\ProdutoRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ProdutosController extends Controller{
    
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $produtos = Produto::orderBy('nome')->paginate(10);
        else
            $produtos = Produto::where('nome', 'like', '%'.$filtragem.'%')
            ->orderBy("nome")
            ->paginate(5);
                // ->setpath('produtos?desc_filtro='+$filtragem);
        return view('produtos.index', ['produtos'=>$produtos]);
    }

    public function create(){ 
        return view('produtos.create');
    }

    public function store(ProdutoRequest $request){ 
        $novo_produto = $request->all();
        $valida_id = DB::table('produtos')->where('id', '=', $request->id)->get()->first();
        if ($valida_id == null){
            Produto::create($novo_produto);
            return redirect()->route('produtos')->with('success', "Produto cadastrado com sucesso!");
        }else{
            Alert::error('Código do produto já utilizado', 'Insira um código que não esteja cadastrado')->persistent('Close');
            return redirect()->back()->withInput();
        }
    }

    public function get_products(){
        return Produto::all();
    }

    public function destroy($id){
        try {
            Produto::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit($id){
        $produto = Produto::find($id);
        return json_encode($produto);
    }

    public function update(ProdutoRequest $request){
        $produto_entrada = DB::table('entradas')->where('produto_id', '=', $request->id)->get();
        $produto = DB::table('produtos')->where('id', '=', $request->id)->get()->first();

        if((!$produto_entrada->isEmpty()) and ($request->nome != $produto->nome) || ($request->id != $produto->id)){
            Alert::error("Produto $produto->nome (Código $produto->id) não pode ser alterado", 'Cadastre um novo produto ou exclua as entradas deste produto para efetuar alteração do nome')->persistent('Close');
            return redirect()->back()->withInput();

        }else{
            Produto::find($request->id)->update($request->all());
            return redirect()->route('produtos')->with('success', "Produto alterado com sucesso!");
        }
    }
}
