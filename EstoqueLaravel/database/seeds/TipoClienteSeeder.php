<?php

use Illuminate\Database\Seeder;
use App\TipoCliente;

class TipoClienteSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        $tipo_clientes_seed = [
            [
                'nome' => 'Bom comprador',
                'descricao' => 'Compra em quantidades altas e/ou sempre está realizando compras',
            ],
            [
                'nome' => 'Mal comprador',
                'descricao' => 'Cliente com determinadas observações',
            ],
            [
                'nome' => 'Positivar',
                'descricao' => 'Cliente em potencial, porém sem compra realizada até o momento',
            ],
            [
                'nome' => 'Devedor',
                'descricao' => 'Comprou a prazo e não realizou quitação',
            ],
            [
                'nome' => 'Cancelado',
                'descricao' => 'Não realizou nenhum pedido, apesar de ser visitado várias vezes.',
            ]
        ];

        foreach ($tipo_clientes_seed as $tcs) {
            TipoCliente::create(array(
                'nome' => $tcs['nome'],
                'descricao' => $tcs['descricao'],
            ));
        }
    }
}
