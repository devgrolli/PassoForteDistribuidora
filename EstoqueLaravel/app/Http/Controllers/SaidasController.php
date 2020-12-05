<?php

namespace App\Http\Controllers;
use App\Saida;
use App\Http\Requests\SaidaRequest;
use Illuminate\Http\Request;

class SaidasController extends Controller{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $saidas = Saida::orderBy('nome')->paginate(10);
        else
            $saidas = Saida::where('nome', 'like', '%'.$filtragem.'%')
            ->orderBy("nome")
            ->paginate(10)
            ->setpath('saidas?desc_filtro='+$filtragem); 
        return view('saidas.index', ['saidas'=>$saidas]);
    }

    public function create(){ 
        return view('saidas.create');
    }

    public function store(SaidaRequest $request){ 
        $nova_saida = $request->all(); 
        Saida::create($nova_saida);
        return redirect()->route('saidass');
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

    public function edit($id){
        $entradas = Saida::find($id);
        return view('saidas.edit', compact('saida'));
    }

    public function update(SaidaRequest $request, $id){
        Saida::find($id)->update($request->all());
        return redirect()->route('saidas');
    }
}
