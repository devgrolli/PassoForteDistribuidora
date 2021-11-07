<?php

namespace App\Http\Controllers;
use App\TipoCliente;
use App\Http\Requests\TipoClienteRequest;

class TipoClientesController extends Controller{
    public function index(){
        $tipo_clientes = TipoCliente::orderBy('nome')->paginate(5);
        return view('tipo_clientes.index', ['tipo_clientes' => $tipo_clientes]);
    }

    public function create(){
        return view('tipo_clientes.create');
    }

    public function store(TipoClienteRequest $request) { // Responsável por gravar um novo registro 
        $novo_tipo_cliente = $request->all();
        TipoCliente::create($novo_tipo_cliente);
        return redirect()->route('tipo_clientes')->with('success', "Tipo de cliente cadastrado com sucesso!");
    }

    public function destroy($id){
        try {
            TipoCliente::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }
    
    public function edit($id){
        $tipo_cliente = TipoCliente::find($id);
        return json_encode($tipo_cliente);
    }

    public function update(TipoClienteRequest $request){
        TipoCliente::find($request->id)->update($request->all());
        return redirect()->route('tipo_clientes');
    }
}
