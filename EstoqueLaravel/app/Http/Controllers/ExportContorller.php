<?php

namespace App\Http\Controllers;
use App\Cliente;
use Illuminate\Http\Request;
use App\Exports\ClientesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

class ExportContorller extends Controller{
    public function export() {
        $verifica_cliente = Cliente::all()->count();
        if ($verifica_cliente == 0){
            Alert::error('Sem clientes cadastrados!', 'Cadastre novos clientes para exportar o PDF');
            return redirect()->route('clientes');
        }else{
            return Excel::download(new ClientesExport, 'clientes.xlsx');
        } 
    }
}
