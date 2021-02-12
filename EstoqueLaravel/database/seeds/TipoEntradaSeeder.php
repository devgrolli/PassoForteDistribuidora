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
        TipoEntrada::create(['nome' => 'Compra']);
        TipoEntrada::create(['nome' => 'Devolução de cliente']);
        TipoEntrada::create(['nome' => 'Transferência entre lojas']);
        TipoEntrada::create(['nome' => 'Retorno de Remessa']);
        TipoEntrada::create(['nome' => 'Ajuste de estoque']);
    }
}
