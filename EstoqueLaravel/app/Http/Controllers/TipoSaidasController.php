<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoSaida;
use App\Http\Requests\TipoSaidaRequest;

class TipoSaidasController extends Controller{
    public function index(){
        $tipo_saidas = TipoSaida::orderBy('nome')->paginate(5);
        return view('tipo_saidas.index', ['tipo_saidas' => $tipo_saidas]);
    }

    public function create(){
        return view('tipo_saidas.create');
    }

    public function store(TipoSaidaRequest $request) { // Responsável por gravar um novo registro 
        $novo_tipo_saida = $request->all();
        TipoSaida::create($novo_tipo_saida);
        return redirect()->route('tipo_saidas')->with('success', "Tipo de saída cadastrada com sucesso!");
    }

    public function destroy($id){
        try {
            TipoSaida::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit($id){
        $tipo_saida = TipoSaida::find($id);
        return json_encode($tipo_saida);
    }

    public function update(TipoSaidaRequest $request){
        TipoSaida::find($request->id)->update($request->all());
        return redirect()->route('tipo_saidas');
    }
}
