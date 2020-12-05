<?php

namespace App\Http\Controllers;
use App\Entrada;
use App\Http\Requests\EntradaRequest;
use Illuminate\Http\Request;

class EntradasController extends Controller{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $entradas = Entrada::orderBy('nome')->paginate(10);
        else
            $entradas = Entrada::where('nome', 'like', '%'.$filtragem.'%')
            ->orderBy("nome")
            ->paginate(10)
            ->setpath('entradas?desc_filtro='+$filtragem); 
        return view('entradas.index', ['entradas'=>$entradas]);
    }

    public function create(){ 
        return view('entradas.create');
    }

    public function store(EntradaRequest $request){ 
        $nova_entrada = $request->all(); 
        Entrada::create($nova_entrada);
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

    public function edit($id){
        $entradas = Entrada::find($id);
        return view('entradas.edit', compact('entrada'));
    }

    public function update(EntradaRequest $request, $id){
        Entrada::find($id)->update($request->all());
        return redirect()->route('entradas');
    }
}
