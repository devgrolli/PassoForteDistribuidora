<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Http\Requests\CategoriaRequest;

class CategoriasController extends Controller{
    public function index(){
        $categorias = Categoria::orderBy('nome')->paginate(5);
        return view('categorias.index', ['categorias' => $categorias]);
    }

    public function create(){
        return view('categorias.create');
    }

    public function store(CategoriaRequest $request) { // Responsável por gravar um novo registro 
        $nova_categoria = $request->all();
        Categoria::create($nova_categoria);
        return redirect()->route('categorias');
    }

    public function destroy($id){
        try {
            Categoria::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit($id){
        $categoria = Categoria::find($id);
        return json_encode($categoria);
    }

    public function update(CategoriaRequest $request){
        Categoria::find($request->id)->update($request->all());
        return redirect()->route('categorias');
    }
}
