<?php

namespace App\Exports;
use DB;
use App\Produto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdutosExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        $excel_prods = DB::table('produtos')
            ->join('categorias', 'produtos.categorias_id', '=', 'categorias.id')
            ->select('produtos.id', 'produtos.nome','produtos.unidade','produtos.marca', 'categorias.nome as categoria')->get();
        
        return $excel_prods;
    }

    public function headings(): array    {
        return [
            'Código',
            'Produto',
            'Unidade',
            'Marca',
            'Categoria'
        ];
    }
}
