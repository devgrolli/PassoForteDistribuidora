<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Produto;
use App\Entrada;
use App\Saida;

use Illuminate\Http\Request;
use App\Exports\ClientesExport;
use App\Exports\ProdutosExport;
use App\Exports\EntradasExport;
use App\Exports\SaidasExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportContorller extends Controller{
    public function export($type) {
        switch ($type) {
            case "clientes":
                $retorno = Cliente::all()->count();
                $download = Excel::download(new ClientesExport, 'clientes.xlsx');
                break;
            case "produtos":
                $retorno = Produto::all()->count();
                $download = Excel::download(new ProdutosExport, 'produtos.xlsx');
                break;
            case "entradas":
                $retorno = Entrada::all()->count();
                $download = Excel::download(new EntradasExport, 'entradas.xlsx');
                break;   
            case "saidas":
                $retorno = Saida::all()->count();
                $download = Excel::download(new SaidasExport, 'saidas.xlsx');
                break;       
        }

        if ($retorno == 0){
            Alert::error("Sem registro de $type!", "Cadastre novos(as) $type para exportar o PDF");
            return redirect()->route($type);
        }else{
            return $download;
        } 
    }
}
