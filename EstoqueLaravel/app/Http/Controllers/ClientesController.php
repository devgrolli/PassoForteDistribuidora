<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Http\Requests\ClienteRequest;

class ClientesController extends Controller{
    public function index(Request $filtro) {
        
        $filtragem = $filtro->get('desc_filtro');

        if ($filtragem == null)
            $clientes = Cliente::orderBy('nome')->paginate(10);
        else
            $clientes = Cliente::where('nome', 'like', '%'.$filtragem.'%')
            ->orderBy("nome")
            ->paginate(10)
            ->setpath('clientes?desc_filtro='+$filtragem); 
        return view('clientes.index', ['clientes'=>$clientes]);
    }

    public function create(){ 
        return view('clientes.create');
    }

    public function store(ClienteRequest $request){ 
        $novo_cliente = $request->all(); 
        Cliente::create($novo_cliente);
        return redirect()->route('clientes');
    }

    public function destroy($id){
        Cliente::find($id)->delete();
        return redirect()->route('clientes');
    }

    public function edit(Request $request){
        $cliente = Cliente::find(\Crypt::decrypt($request->get('id')));
        return view('clientes.edit', compact('cliente'));
    }

    public function update(ClienteRequest $request, $id){
        Cliente::find($id)->update($request->all());
        return redirect()->route('clientes');
    }
}
