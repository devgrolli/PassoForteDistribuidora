<?php

namespace App\Http\Controllers;
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

    public function filter(Request $filter){
        switch ($filter->type_filter) {
            case "1": $estoque = Produto::orderBy('quantidade', 'desc')->where('quantidade', '>', 0)->paginate(10);
            case "2": $estoque = Produto::orderBy('quantidade', 'desc')->where('quantidade', '=', 0 )->paginate(10);
            default: $estoque = Produto::orderBy('quantidade', 'desc')->paginate(10);
        }
        return view('estoque.index', ['estoque'=>$estoque]);
        // return view('estoque.estoque', ['estoque'=>$estoque]);      
    }

}
