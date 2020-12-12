<?php

namespace App\Http\Controllers;
use App\Saida;
use App\Produto;
use App\Http\Requests\SaidaRequest;
use Illuminate\Http\Request;

class SaidasController extends Controller{
    // public function index(Request $filtro) {
    //     $filtragem = $filtro->get('desc_filtro');
    //     if ($filtragem == null)
    //         $saidas = Saida::orderBy('nome')->paginate(10);
    //     else
    //         $saidas = Saida::where('nome', 'like', '%'.$filtragem.'%')
    //         ->orderBy("nome")
    //         ->paginate(10)
    //         ->setpath('saidas?desc_filtro='+$filtragem); 
    //     return view('saidas.index', ['saidas'=>$saidas]);
    // }

    public function index() {
		$saidas = Saida::orderBy('id')->paginate(5);
		return view('saidas.index', ['saidas'=>$saidas]);
	}

    public function create(){ 
        return view('saidas.create');
    }

    public function store(SaidaRequest $request){ 
        dd($request);
        $nova_saida = $request->all(); 
        Saida::create($nova_saida);
        // $busca_produto = Produto::find($request->produto_id);
        // $busca_produto->quantidade = $busca_produto->quantidade - $request->quantidade;
        // $busca_produto->save();
        return redirect()->route('saidas');
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

    public function edit(Request $request){
        $saida = Saida::find(\Crypt::decrypt($request->get('id')));
        return view('saidas.edit', compact('saida'));
    }

    public function update(SaidaRequest $request, $id){
        Saida::find($id)->update($request->all());
        return redirect()->route('saidas');
    }
}
