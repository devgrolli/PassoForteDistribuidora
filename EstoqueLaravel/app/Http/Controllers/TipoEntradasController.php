<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoEntrada;
use App\Http\Requests\TipoEntradaRequest;

class TipoEntradasController extends Controller{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $tipo_entradas = TipoEntrada::orderBy('nome')->paginate(10);
        else
            $tipo_entradas = TipoEntrada::where('nome', 'like', '%'.$filtragem.'%')
            ->orderBy("nome")
            ->paginate(10)
            ->setpath('tipo_entradas?desc_filtro='+$filtragem); 
        return view('tipo_entradas.index', ['tipo_entradas'=>$tipo_entradas]);
    }

    public function create(){ 
        return view('tipo_entradas.create');
    }

    public function store(TipoEntradaRequest $request){ 
        $novo_tipo_entrada = $request->all(); 
        TipoEntrada::create($novo_tipo_entrada);
        return redirect()->route('tipo_entradas');
    }

    public function destroy($id){
        try {
            TipoEntrada::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit(Request $request){
        $tipo_entradas = TipoEntrada::find(\Crypt::decrypt($request->get('id')));
        return view('tipo_entradas.edit', compact('tipo_entrada'));
    }

    public function update(TipoEntradaRequest $request, $id){
        TipoEntrada::find($id)->update($request->all());
        return redirect()->route('tipo_entradas');
    }
}
