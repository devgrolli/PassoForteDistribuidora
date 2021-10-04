<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class EntradasExport implements FromCollection, WithHeadings{
    private $dados;
    public function __construct(object $dados){
        $this->dados = $dados;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return $this->dados;
    }

    public function headings(): array {
        return [
            'Código produto',
            'Produto',
            'Quantidade',
            'Preço Unitário',
            'Validade',
            'Fornecedor',
            'Tipo da Entrada',
            'Data da Entrada',
            'Observações'
        ];
    }
}
