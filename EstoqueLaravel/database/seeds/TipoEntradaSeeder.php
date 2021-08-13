<?php

use Illuminate\Database\Seeder;
use App\TipoEntrada;

class TipoEntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $tipo_entradas_seed = [
            [
                'nome' => 'Troca',
                'descricao' => 'Negociação com o fornecedor',
            ],
            [
                'nome' => 'Reposição de estoque',
                'descricao' => 'Principal entrada para reposição do estoque após pedido com fornecedor',
            ],
            [
                'nome' => 'Devolução de mercadoria',
                'descricao' => 'Problemas com o pedido realizado',
            ],
            [
                'nome' => 'Reajuste preço fornecedor',
                'descricao' => 'Quando ocorre um aumento do produto referente aos que já foram cadastrados',
            ],
            [
                'nome' => 'Ajuste de estoque',
                'descricao' => 'Entrada de manutenção de algum erro e etc.',
            ]
        ];

        foreach ($tipo_entradas_seed as $seed) {
            TipoEntrada::create(array(
                'nome' => $seed['nome'],
                'descricao' => $seed['descricao'],
            ));
        }
    }
}
