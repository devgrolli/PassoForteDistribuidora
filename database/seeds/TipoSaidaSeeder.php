<?php

use Illuminate\Database\Seeder;
use App\TipoSaida;

class TipoSaidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        TipoSaida::create(['nome' => 'Venda']);
        TipoSaida::create(['nome' => 'Troca de produto']);
        TipoSaida::create(['nome' => 'Devolução ao Fornecedor']);
        TipoSaida::create(['nome' => 'Remessa']);
        TipoSaida::create(['nome' => 'Ajuste de Estoque']);
        TipoSaida::create(['nome' => 'Bonificação']);
        TipoSaida::create(['nome' => 'Outras Saídas']);
    }
}
