<?php

namespace App\Http\Controllers;
use App\Entrada;
use App\Produto;
use App\TipoEntrada;
use DB;
use App\Http\Requests\EntradaRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EntradasController extends Controller{
    public function index() {
		$entradas = Entrada::orderBy('id')->paginate(10);
		return view('entradas.index', ['entradas'=>$entradas]);
	}

    public function create(){ 
        $products = Produto::all();
        return view('entradas.create', compact('products'));
    }

    public function store(EntradaRequest $request){
        $nova_entrada = $request->all(); 
        $estoque_produto = Produto::find($request->produto_id);
        $all_entradas = DB::table('entradas')->get();

        $validate_tipo_id = DB::table('tipo_entradas')->where('id', '=', $request->tipo_entrada_id)->get()->first();
        $produto_utilizado = DB::table('entradas')->where('produto_id', '=', $request->produto_id)->get();

        if ($request->quantidade == 0 || $request->quantidade < 0) {
            Alert::error('Quantidade Inválida', 'Insira uma quantidade maior que zero')->persistent('Close');
            return redirect()->back()->withInput();

        }else{
            $popula_table = 'NA';
            if(!$all_entradas->isEmpty()){
                foreach($all_entradas as $all){
                    if ($request->preco_un > $all->preco_un){
                        $popula_table = 'VALOR ACIMA';
                        break;
                    }else if ($request->preco_un < $all->preco_un){
                        $popula_table = 'VALOR ABAIXO';
                        break;
                    }
                }
            }
            $nova_entrada = array_merge($nova_entrada, array("status_preco" => $popula_table));
            $nova_entrada['preco_un'] = UtilController::formataMoeda($request->preco_un);
            Entrada::create($nova_entrada);
            $estoque_produto->quantidade += $request->quantidade;
            $estoque_produto->save();
            return redirect()->route('entradas')->with('success', "Entrada cadastrada com sucesso!");
        }    
    }

    public function destroy($id){
        try {
            EntradasController::atualizaEstoque($id);
            Entrada::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function atualizaEstoque($id_destroy){
        $entrada = Entrada::find($id_destroy);
        $update_estoque = Produto::find($entrada->produto_id);
        $entrada->quantidade > $update_estoque->quantidade ? $update_estoque->quantidade = 0 : $update_estoque->quantidade -= $entrada->quantidade;
        $update_estoque->save();
    }

    public function edit(Request $request){
        $entrada = Entrada::find(\Crypt::decrypt($request->get('id')));
        return view('entradas.edit', compact('entrada'));
    }

    public function update(EntradaRequest $request, $id){
        $busca_produto = Produto::find($request->produto_id);
        if ($request->quantidade == 0){
            Alert::error('Quantidade zerada', 'Saída não realizada devido a quantidade estar zerada')->persistent('Close');
            return redirect()->back()->withInput();
         
        }else if ($busca_produto->quantidade == 0){  
            Alert::error('Produto sem estoque', "Tente outro produto")->persistent('Close');
            return redirect()->back()->withInput();
        
        }else{
            Entrada::find($id)->update($request->all());
            $busca_produto->quantidade = $request->quantidade;
            $busca_produto->save();
            return redirect()->route('entradas')->with('success', "Entrada de produto alterada com sucesso!");
        }
    }
}
