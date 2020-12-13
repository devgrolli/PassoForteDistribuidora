<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Http\Requests\ProdutoRequest;

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
        Produto::create($novo_produto);
        return redirect()->route('produtos');
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

    public function edit(Request $request){
        $produto = Produto::find(\Crypt::decrypt($request->get('id')));
        return view('produtos.edit', compact('produto'));
    }

    public function update(ProdutoRequest $request, $id){
        Produto::find($id)->update($request->all());
        return redirect()->route('produtos');
    }
}
