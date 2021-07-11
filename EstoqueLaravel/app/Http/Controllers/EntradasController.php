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



        /*
            - Se já foi cadastrado entrada de um produto e o tipo de entrada for 'REPOSIÇÃO DE ESTOQUE', o valor de entrada do produto deve ser igual à entrada cadastrada
            - Se o tipo de entrada for igual a 'Reajuste preço fornecedor', poderá alterar pra qualquer valor
        */

        if ($request->quantidade == 0 || $request->quantidade < 0) {
            Alert::error('Quantidade Inválida', 'Insira uma quantidade maior que zero')->persistent('Close');
            return redirect()->back()->withInput();

        }else if ((mb_strtoupper($validate_tipo_id->nome, 'UTF-8') == 'REAJUSTE PREÇO FORNECEDOR') && (!$all_entradas->isEmpty()) && ($produto_utilizado->count() > 0)){
            
            dd($all_entradas);

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
            $nova_entrada['preco_un'] = ProdutosController::formataMoeda($request->preco_un);
            Entrada::create($nova_entrada);
            $estoque_produto->quantidade += $request->quantidade;
            $estoque_produto->save();
            return redirect()->route('entradas')->with('success', "Entrada cadastrada com sucesso!");
        }    
    }

    public function destroy($id){
        try {
            Entrada::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request){
        $entrada = Entrada::find(\Crypt::decrypt($request->get('id')));
        return view('entradas.edit', compact('entrada'));
    }

    public function stock($id){
        $busca_produto_entrada = Entrada::find($id)->first();
        $produto = Produto::find($busca_produto_entrada->produto_id)->first();
        $produto->quantidade = $produto->quantidade - $busca_produto_entrada->quantidade;
        $resposta = $produto->save();
        if($resposta == false){
            $result = json_enconde(['error' => $produto]);
            return response()->json($result, 404);
        }
        $result = json_enconde($produto);
        return response()->json($result, 200);
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
