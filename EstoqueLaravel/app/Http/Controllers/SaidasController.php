<?php

namespace App\Http\Controllers;
use App\Saida;
use App\Produto;
use App\Http\Requests\SaidaRequest;
use Illuminate\Http\Request;

class SaidasController extends Controller{
    public function index() {
		$saidas = Saida::orderBy('id')->paginate(10);
		return view('saidas.index', ['saidas'=>$saidas]);
	}

    public function create(){ 
        return view('saidas.create');
    }

    public function store(SaidaRequest $request){ 
        $nova_saida = $request->all(); 
        $estoque_produto = Produto::find($request->produto_id);
        if ($request->quantidade > $estoque_produto->quantidade) {
            return redirect()->back()->withInput()->with('error', "Desculpe, há somente $request->quantidade produtos em estoque");
        }else{
            Saida::create($nova_saida);
            $estoque_produto->quantidade = $estoque_produto->quantidade - $request->quantidade;
            $estoque_produto->save();
            return redirect()->route('saidas')->with('success', "Saída cadastrada com sucesso!");;
        }  
    }

    public function destroy($id){
        dd($id);
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

    public function edit(Request $request){
        $saida = Saida::find(\Crypt::decrypt($request->get('id')));
        return view('saidas.edit', compact('saida'));
    }

    public function update(SaidaRequest $request, $id){
        Saida::find($id)->update($request->all());
        $busca_produto = Produto::find($request->produto_id);
        if ($busca_produto->quantidade != 0){ 
            $busca_produto->quantidade = $busca_produto->quantidade - $request->quantidade;
            $busca_produto->save();
        }
        return redirect()->route('saidas');
    }
}
