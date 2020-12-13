<?php

namespace App\Http\Controllers;
use App\Entrada;
use App\Produto;
use App\Http\Requests\EntradaRequest;
use Illuminate\Http\Request;

class EntradasController extends Controller{
    public function index() {
		$entradas = Entrada::orderBy('id')->paginate(5);
		return view('entradas.index', ['entradas'=>$entradas]);
	}

    public function create(){ 
        return view('entradas.create');
    }

    public function store(EntradaRequest $request){ 
        $nova_entrada = $request->all(); 
        Entrada::create($nova_entrada);
        $busca_produto = Produto::find($request->produto_id);
        $busca_produto->quantidade = $busca_produto->quantidade + $request->quantidade;
        $busca_produto->save();
        return redirect()->route('entradas');
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

    public function update(EntradaRequest $request, $id){
        Entrada::find($id)->update($request->all());
        $busca_produto = Produto::find($request->produto_id);
        $busca_produto->quantidade = $busca_produto->quantidade + $request->quantidade;
        $busca_produto->save();
        return redirect()->route('entradas');
    }
}
