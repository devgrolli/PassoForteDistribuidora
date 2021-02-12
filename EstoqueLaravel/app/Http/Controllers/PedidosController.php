<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use Validator; 
use App\Http\Requests\PedidoRequest;

class PedidosController extends Controller{
    public function index(){
        $pedidos = Pedido::orderBy('produto')->paginate(5);
        return view('pedidos.index', ['pedidos' => $pedidos]);
    }

    public function create(){
        return view('pedidos.create');
    }

    public function store(PedidoRequest $request){ // Responsável por gravar um novo registro 
        $novo_pedido = $request->all();
        if($request->ajax()){
            $rules = array('nome.* ' => 'required',
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails()){
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }
            $nome = $request->nome;
            for($count =0; $count < count($nome); $count++){
                $data = array(
                    'nome' => $nome[$count]
                );
                $insert_data[] = $data;
                Produto::insert($insert_data);
                return response()->json([
                    'success' => 'Dado adicionado'
                ]);
            }
        }
        Pedido::create($novo_pedido);
        return redirect()->route('pedidos');
    }

    public function destroy($id){
        try {
            Pedido::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit(Request $request){
        $pedido = Pedido::find(\Crypt::decrypt($request->get('id')));
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(PedidoRequest $request, $id) {
        Pedido::find($id)->update($request->all());
        return redirect()->route('pedidos');
    }
}