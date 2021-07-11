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
        TipoEntrada::create(['nome' => 'Troca']);
        TipoEntrada::create(['nome' => 'Reposição de estoque']);
        TipoEntrada::create(['nome' => 'Devolução de mercadoria']);
        TipoEntrada::create(['nome' => 'Reajuste preço fornecedor']);
        TipoEntrada::create(['nome' => 'Ajuste de estoque']);
    }
}
