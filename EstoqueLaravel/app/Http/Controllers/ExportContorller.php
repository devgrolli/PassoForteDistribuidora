<?php

namespace App\Http\Controllers;
use App\Exports\ClientesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportContorller extends Controller{
    public function export() {
        return Excel::download(new ClientesExport, 'clientes.xlsx');
    }
}
