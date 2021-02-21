<?php

namespace App\Exports;
use DB;
use App\Saida;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SaidasExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        $excel_entradas = DB::table('saidas')
            ->join('produtos', 'saidas.produto_id', '=', 'produtos.id')
            ->join('tipo_saidas', 'saidas.tipo_saidas_id', '=', 'tipo_saidas.id')
            ->select('produtos.id as cod_prod','produtos.nome as produto', 'saidas.quantidade', 
                     'saidas.preco_un', 'tipo_saidas.nome as tipo_saida', 'saidas.observacoes')->get();

        return $excel_entradas;
    }

    public function headings(): array    {
        return [
            'Código produto',
            'Produto',
            'Quantidade',
            'Preço Unitário',
            'Tipo da Saída',
            'Observações'
        ];
    }
}
