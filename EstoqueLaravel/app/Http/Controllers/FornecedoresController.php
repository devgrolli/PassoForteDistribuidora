<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use App\Http\Requests\FornecedorRequest;

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
        Fornecedor::create($novo_fornecedor);
        return redirect()->route('fornecedores');
    }

    public function destroy($id){
        Fornecedor::find($id)->delete();
        return redirect()->route('fornecedores');
    }

    public function edit($id){
        $fornecedor = Fornecedor::find($id);
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(FornecedorRequest $request, $id) {
        Fornecedor::find($id)->update($request->all());
        return redirect()->route('fornecedores');
    }
}
