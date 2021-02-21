<?php

namespace App\Exports;
use DB;
use App\Entrada;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntradasExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        $excel_entradas = DB::table('entradas')
            ->join('produtos', 'entradas.produto_id', '=', 'produtos.id')
            ->join('fornecedores', 'entradas.fornecedor_id', '=', 'fornecedores.id')
            ->join('tipo_entradas', 'entradas.tipo_entrada_id', '=', 'tipo_entradas.id')
            ->select('produtos.id as cod_prod','produtos.nome as produto', 'entradas.quantidade', 
                     'entradas.preco_un','entradas.validade', 'fornecedores.razao_social as fornecedor', 
                     'tipo_entradas.nome as tipo_entrada', 'entradas.observacoes')->get();

        return $excel_entradas;
    }

    public function headings(): array    {
        return [
            'Código produto',
            'Produto',
            'Quantidade',
            'Preço Unitário',
            'Validade',
            'Fornecedor',
            'Tipo da Entrada',
            'Observações'
        ];
    }
}
