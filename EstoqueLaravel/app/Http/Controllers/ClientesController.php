<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cliente;
use App\TipoCliente;
use App\Http\Requests\ClienteRequest;

class ClientesController extends Controller{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $clientes = Cliente::orderBy('nome')->paginate(10);
        else
            $clientes = Cliente::where('nome', 'like', '%'.$filtragem.'%')
            ->orderBy("nome")
            ->paginate(5);
            // ->setpath('clientes?desc_filtro='+$filtragem); 
        $nome_clientes = Cliente::all();
        foreach ($nome_clientes as $nome_cliente) {
            $nome_tipo = $nome_cliente->tipo_cliente->nome;
            switch ($nome_tipo) {
                case "Bom comprador":
                    $numero = 1;
                    break;
                case "Cancelado":
                case "Devedor":
                    $numero = 2;
                    break; 
                case "Positivar":
                    $numero = 3;
                    break;      
                case "Mal comprador":
                    $numero = 4;
                    break;        
                                   
            }
            $nome_cliente->categoria_cliente = $numero;
            $nome_cliente->save();
        }
        return view('clientes.index', ['clientes'=>$clientes]);
    }

    public function create(){ 
        return view('clientes.create');
    }

    public function store(ClienteRequest $request){ 
        $novo_cliente = $request->all();
        Cliente::create($novo_cliente);
        return redirect()->route('clientes')->with('success', "Cliente cadastrado com sucesso!");
    }

    public function destroy($id){
        try {
            Cliente::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit(Request $request){
        $cliente = Cliente::find(\Crypt::decrypt($request->get('id')));
        return view('clientes.edit', compact('cliente'));
    }

    public function update(ClienteRequest $request, $id){
        Cliente::find($id)->update($request->all());
        return redirect()->route('clientes')->with('success', "Cliente alterado com sucesso!");
    }
    
}
