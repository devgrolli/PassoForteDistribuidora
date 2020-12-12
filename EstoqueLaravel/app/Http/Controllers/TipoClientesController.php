<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return redirect()->route('tipo_clientes');
    }

    public function destroy($id){
        TipoCliente::find($id)->delete();
        return redirect()->route('tipo_clientes');
    }

    public function edit(Request $request){
        $tipo_cliente = TipoCliente::find(\Crypt::decrypt($request->get('id')));
        return view('tipo_clientes.edit', compact('tipo_cliente'));
    }

    public function update(TipoClienteRequest $request, $id){
        TipoCliente::find($id)->update($request->all());
        return redirect()->route('tipo_clientes');
    }
}
