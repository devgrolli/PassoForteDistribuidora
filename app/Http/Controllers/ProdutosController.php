<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrada;
use App\Saida;
use App\Produto;
use App\Http\Requests\ProdutoRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProdutosController extends Controller{
    
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $produtos = Produto::orderBy('id')->where('is_excluded', '=', false)->paginate(10);
        else if(is_numeric($filtragem)){
            $produtos = Produto::where('id', 'ilike', '%'.$filtragem.'%')->orderBy('nome')->where('is_excluded', '=', false)->paginate(5);
        }else{
            $produtos = Produto::where('nome', 'ilike', '%'.$filtragem.'%')->orderBy('nome')->where('is_excluded', '=', false)->paginate(5);
        } 
        return view('produtos.index', ['produtos'=>$produtos]);
    }

    public function create(){ 
        return view('produtos.create');
    }

    public function store(ProdutoRequest $request){ 
        $novo_produto = $request->all();
        $validate_store = DB::table('produtos')->where('id', '=', $request->id)->get()->first();
        if ($validate_store == null){
            Produto::create($novo_produto);
            return redirect()->route('produtos')->with('success', "Produto cadastrado com sucesso!");

        }else if($validate_store->is_excluded == true && $validate_store->id != null){
            DB::table('produtos')->where('id', '=', $request->id)->update($request->except(['_token']));
            Produto::where('id', '=', $request->id)->update(['is_excluded' => false, 'updated_at' => date('d/m/Y H:i:s', time())]);
            return redirect()->route('produtos')->with('success', "Produto cadastrado com sucesso!");

        }else{
            Alert::error('Código do produto já utilizado', 'Insira um código que não esteja cadastrado')->persistent('Close');
            return redirect()->back()->withInput();
        }
    }

    public static function get_all_products(){
        return Produto::all();
    }

    public function destroy($id){
        $has_saidas = Saida::where('produto_id', '=', $id)->where('is_excluded', '=', false)->get();
        $has_entradas = Entrada::where('produto_id', '=', $id)->where('is_excluded', '=', false)->get();

        if($has_saidas->isEmpty() && ($has_entradas->isEmpty())){
            $exclused = Produto::where('id', '=', $id)->update(['is_excluded' => true, 'deleted_at' => date('d/m/Y H:i:s', time())]);
            $ret = $exclused == 1 ?array('status'=>200, 'msg'=>"Exclusão lógica confirmada") : array('status'=>501, 'msg'=>'Ocorreu um erro ao excluir produto, contate o suporte');
        }else{
            $ret = array('status'=>501, 'msg'=>'Há Entradas/Saídas cadastradas com este produto');
        }
        return $ret; 
    }

    public function edit($id){
        $produto = Produto::find($id);
        return json_encode($produto);
    }

    public function update(ProdutoRequest $request){
        $produto_entrada = DB::table('entradas')->where('produto_id', '=', $request->id)->get();
        $produto = DB::table('produtos')->where('id', '=', $request->id)->get()->first();

        if((!$produto_entrada->isEmpty()) and ($request->nome != $produto->nome) || ($request->id != $produto->id)){
            Alert::error("Produto $produto->nome (Código $produto->id) não pode ser alterado", 'Cadastre um novo produto ou exclua as entradas deste produto para efetuar alteração do nome')->persistent('Close');
            return redirect()->back()->withInput();

        }else{
            Produto::find($request->id)->update($request->all());
            return redirect()->route('produtos')->with('success', "Produto alterado com sucesso!");
        }
    }
}
