<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Fornecedor;
use App\Http\Requests\FornecedorRequest;
use RealRashid\SweetAlert\Facades\Alert;

class FornecedoresController extends Controller{
    public function index(){
        $fornecedores = Fornecedor::orderBy('razao_social')->paginate(5);
        return view('fornecedores.index', ['fornecedores' => $fornecedores]);
    }

    public function create(){
        return view('fornecedores.create');
    }

    public function store(FornecedorRequest $request){ // Responsável por gravar um novo registro 
        $novo_fornecedor = $request->all();
        // $telefone_formatado = preg_replace("/[^0-9]/", "", $request->telefone);
        // $novo_fornecedor['telefone'] = $telefone_formatado;
        $valida_cnpj = DB::table('fornecedores')->where('cnpj', '=', $request->cnpj)->get()->first();
        if ($valida_cnpj == null){
            Fornecedor::create($novo_fornecedor);
            return redirect()->route('fornecedores')->with('success', "Fornecedor cadastrado com sucesso!");
        }else{
            Alert::error('CNPJ já cadastrado', 'Insira outro cnpj para realizar o cadastro')->persistent('Close');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id){
        try {
            Fornecedor::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit(Request $request){
        $fornecedor = Fornecedor::find(\Crypt::decrypt($request->get('id')));
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(FornecedorRequest $request, $id) {
        Fornecedor::find($id)->update($request->all());
        return redirect()->route('fornecedores')->with('success', "Fornecedor editado com sucesso!");
    }
}
