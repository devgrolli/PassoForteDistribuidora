<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoSaida;
use App\Http\Requests\TipoSaidaRequest;

class TipoSaidasController extends Controller{
    public function index(){
        $tipo_saidas = TipoSaida::orderBy('nome')->paginate(5);
        return view('tipo_saidas.index', ['tipo_saidas' => $tipo_saidas]);
    }

    public function create(){
        return view('tipo_saidas.create');
    }

    public function store(TipoSaidaRequest $request) { // Responsável por gravar um novo registro 
        $novo_tipo_saida = $request->all();
        TipoSaida::create($novo_tipo_saida);
        return redirect()->route('tipo_saidas');
    }

    public function destroy($id){
        TipoSaida::find($id)->delete();
        return redirect()->route('tipo_saidas');
    }

    public function edit(Request $request){
        $tipo_saida = TipoSaida::find(\Crypt::decrypt($request->get('id')));
        return view('tipo_saidas.edit', compact('tipo_saida'));
    }

    public function update(TipoSaidaRequest $request, $id){
        TipoSaida::find($id)->update($request->all());
        return redirect()->route('tipo_saidas');
    }
}
