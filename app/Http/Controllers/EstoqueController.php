<?php

namespace App\Http\Controllers;
use DB;
use App\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $estoque = Produto::orderBy('quantidade', 'desc')->paginate(10);
        else
            $estoque = Produto::where('nome', 'like', '%'.$filtragem.'%')
            ->orderBy('quantidade', 'desc')
            ->paginate(5);
                // ->setpath('produtos?desc_filtro='+$filtragem);            
        return view('estoque.index', ['estoque'=>$estoque]);
    }

}
