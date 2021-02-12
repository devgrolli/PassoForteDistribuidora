<?php

use Illuminate\Database\Seeder;
use App\TipoCliente;

class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        TipoCliente::create(['nome' => 'Bom comprador']);
        TipoCliente::create(['nome' => 'Mal comprador']);
        TipoCliente::create(['nome' => 'Positivar']);
        TipoCliente::create(['nome' => 'Devedor']);
        TipoCliente::create(['nome' => 'Cancelado']);
    }
}
