<?php

namespace App\Exports;
use DB;
use App\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        $excel_clientes = DB::table('clientes')
            ->join('tipo_clientes', 'clientes.tipo_cliente_id', '=', 'tipo_clientes.id')
            ->select('clientes.id', 'clientes.nome','clientes.email','clientes.telefone', 
                     'clientes.endereco', 'tipo_clientes.nome as tipo_cliente', 'clientes.descricao')->get();
        
        return $excel_clientes;
    }

    public function headings(): array    {
        return [
            'Código',
            'Nome',
            'E-mail',
            'Telefone',
            'Endereço',
            'Tipo de Cliente',
            'Descrição'
        ];
    }
}
