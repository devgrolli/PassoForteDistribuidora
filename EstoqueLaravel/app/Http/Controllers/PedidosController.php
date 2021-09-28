<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pedido;
use App\Http\Requests\PedidoRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PedidosController extends Controller{
    public function index(Request $filtro) {
        // $filtragem = $filtro->get('desc_filtro');
        // if ($filtragem == null)
        //     $pedidos = Pedido::orderBy('pedidos')->paginate(10);
        // else
        //     $pedidos = Pedido::where('produto', 'like', '%'.$filtragem.'%')
        //     ->orderBy("produto")
        //     ->paginate(5);
        //     // ->setpath('clientes?desc_filtro='+$filtragem);
        $pedidos = Pedido::orderBy('id')->where('is_excluded', '=', false)->paginate(10);
        return view('pedidos.index', ['pedidos'=>$pedidos]);
    }

    public function create(){
        return view('pedidos.create');
    }

    public function store(Request $request){ // Responsável por gravar um novo registro
        $count = count($request->quantidades);
        $json = array();
        $i = 0;
        while ($count != 0) {
            $json[] = array("quantidade" => $request->quantidades[$i], "produto" => $request->produtos[$i]);
            $count--;
            $i++;
        }
        $pedido = new Pedido;
        $pedido->data_pedido = $request->data_pedido;
        $pedido->fornecedor_id = $request->fornecedor_id;
        $pedido->items = $json;
        $response = $pedido->save();
        if($response == true){
            return redirect()->route('pedidos')->with('success', "Pedido cadastrado com sucesso!");
        }else{
            Alert::error('Erro inesperado', "Contate o suporte")->persistent('Close');
            return redirect()->back()->withInput();
        }
    }

    public function getPedidos($id){
        $pedidos = Pedido::find($id);
        return json_encode($pedidos);
    }

    public function destroy($id){
        $pedidos = Pedido::find($id);
        $pedidos->is_excluded = true;
        $pedidos->deleted_at = date('d/m/Y H:i:s', time());
        return $pedidos->save() ? array('status'=>200, 'msg'=>"null") : array('status'=>500, 'msg'=>'error');
    }

    public function edit(Request $request){
        $pedido = Pedido::find(\Crypt::decrypt($request->get('id')));
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(PedidoRequest $request, $id) {
        Pedido::find($id)->update($request->all());
        return redirect()->route('pedidos')->with('success', "Pedido alterador com sucesso!");
    }
}