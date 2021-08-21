<?php

namespace App\Http\Controllers;

use DB;
use Carbon;
use App\Produto;
use Illuminate\Http\Request;
use App\Exports\ClientesExport;
use App\Exports\ProdutosExport;
use App\Exports\EntradasExport;
use App\Exports\SaidasExport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ExportContorller extends Controller{
    public function export(Request $request, $type){
        $return_query = ExportContorller::queryExport($request, $type);;
        switch ($type){
            case "clientes":
                if(!$return_query->isEmpty()){
                    switch($request->type_doc){
                        case '1': return Excel::download(new ClientesExport($return_query), 'clientes.xlsx');
                        case '2': return 'PDF';
                        case '3': return 'VIEW';
                    }
                } else {
                    Alert::error("Sem registro", 'Não há clientes cadastrados!')->persistent('Close');
                    return redirect()->back()->withInput();
                }

            case "produtos":
                if(!$return_query->isEmpty()){
                    switch($request->type_doc){
                        case '1': return Excel::download(new ProdutosExport($return_query), 'produtos.xlsx');
                        case '2': return 'PDF';
                        case '3': return 'VIEW';
                    }
                } else {
                    Alert::error("Sem registro", 'Não há produtos cadastrados no intervalo selecionado!')->persistent('Close');
                    return redirect()->back()->withInput();
                }

            case "entradas":
                if(!$return_query->isEmpty()){
                    switch($request->type_doc){
                        case '1': return Excel::download(new EntradasExport($return_query), 'entradas.xlsx');
                        case '2': return 'PDF';
                        case '3': return 'VIEW';
                    }
                } else {
                    Alert::error("Sem registro", 'Não há entradas no intervalo selecionado!')->persistent('Close');
                    return redirect()->back()->withInput();
                }

            case "saidas":
                if(!$return_query->isEmpty()){
                    switch($request->type_doc){
                        case '1': return Excel::download(new SaidasExport($return_query), 'saidas.xlsx');
                        case '2': return 'PDF';
                        case '3': return 'VIEW';
                    }
                } else {
                    Alert::error("Sem registro", 'Não há saídas no intervalo selecionado!')->persistent('Close');
                    return redirect()->back()->withInput();
                }
        }
    }

    public function queryExport($request, $type){
        switch ($type) {
            case "clientes":
                $query_db = DB::table('clientes')
                    ->join('tipo_clientes', 'clientes.tipo_cliente_id', '=', 'tipo_clientes.id')
                    ->select(
                        'clientes.id',
                        'clientes.nome',
                        'clientes.email',
                        'clientes.telefone',
                        'clientes.endereco',
                        'tipo_clientes.nome as tipo_cliente',
                        'clientes.created_at',
                        'clientes.descricao'
                    )->get();
                if(!$query_db->isEmpty()) { foreach ($query_db as $query) { $query->created_at = Carbon\Carbon::parse($query->created_at)->format('d/m/Y'); } }
                break;

            case "produtos":
                $query_db = DB::table('produtos')
                    ->join('categorias', 'produtos.categorias_id', '=', 'categorias.id')
                    ->select('produtos.id', 'produtos.nome', 'produtos.unidade', 'produtos.marca', 'categorias.nome as categoria', 'produtos.created_at')
                    ->whereBetween('produtos.created_at', [$request->start_date, $request->end_date])->get();
                if (!$query_db->isEmpty()) { foreach ($query_db as $query) { $query->created_at = Carbon\Carbon::parse($query->created_at)->format('d/m/Y'); } }
                break;
            
            case "entradas":
                $query_db = DB::table('entradas')
                    ->join('produtos', 'entradas.produto_id', '=', 'produtos.id')
                    ->join('fornecedores', 'entradas.fornecedor_id', '=', 'fornecedores.id')
                    ->join('tipo_entradas', 'entradas.tipo_entrada_id', '=', 'tipo_entradas.id')
                    ->select(
                        'produtos.id as cod_prod',
                        'produtos.nome as produto',
                        'entradas.quantidade',
                        'entradas.preco_un',
                        'entradas.validade',
                        'fornecedores.razao_social as fornecedor',
                        'tipo_entradas.nome as tipo_entrada',
                        'entradas.observacoes',
                        'entradas.created_at'
                    )->whereBetween('entradas.created_at', [$request->start_date, $request->end_date])->get();
                if (!$query_db->isEmpty()) {
                    foreach ($query_db as $query) {
                        $query->created_at = Carbon\Carbon::parse($query->created_at)->format('d/m/Y');
                        $query->validade = Carbon\Carbon::parse($query->validade)->format('d/m/Y');
                        $query->preco_un = number_format($query->preco_un, 2, ',', '.');
                    }
                }
                break;
            
            case "saidas":
                $query_db = DB::table('saidas')
                    ->join('produtos', 'saidas.produto_id', '=', 'produtos.id')
                    ->join('tipo_saidas', 'saidas.tipo_saidas_id', '=', 'tipo_saidas.id')
                    ->select(
                        'produtos.id as cod_prod',
                        'produtos.nome as produto',
                        'saidas.validade_produto',
                        'saidas.quantidade',
                        'saidas.preco_un',
                        'saidas.preco_saida',
                        'tipo_saidas.nome as tipo_saida',
                        'saidas.created_at',
                        'saidas.observacoes'
                    )->whereBetween('saidas.created_at', [$request->start_date, $request->end_date])->get();
                if(!$query_db->isEmpty()) {
                    foreach ($query_db as $query) {
                        $query->created_at = Carbon\Carbon::parse($query->created_at)->format('d/m/Y');
                        $query->preco_un = number_format($query->preco_un, 2, ',', '.');
                        $query->preco_un = number_format($query->preco_saida, 2, ',', '.');
                    }
                }
                break;
        }
        return $query_db;
    }
}
