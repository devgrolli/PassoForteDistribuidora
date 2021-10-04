<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaSeeder extends Seeder{
    /** php artisan db:seed
     * Run the database seeds.
     * php artisan migrate
     * 
     * @return void
     */
    public function run()    {
        Categoria::create(['nome' => 'Bolacha']);
        Categoria::create(['nome' => 'Biscoito']);
        Categoria::create(['nome' => 'Salgadinho']);
        Categoria::create(['nome' => 'Doce']);
        Categoria::create(['nome' => 'Higiene pessoal']);
    }
}
