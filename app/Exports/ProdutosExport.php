<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdutosExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $dados;
    public function __construct(object $dados){
        $this->dados = $dados;
    }
    public function collection() {
        return $this->dados;
    }

    public function headings(): array    {
        return [
            'Código',
            'Produto',
            'Unidade',
            'Marca',
            'Categoria',
            'Data do Cadastro'
        ];
    }
}
