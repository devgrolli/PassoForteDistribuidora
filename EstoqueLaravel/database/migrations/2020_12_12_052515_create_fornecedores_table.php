<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cnpj', 14);
            $table->string('razao_social', 100);
            $table->string('email', 60);
            $table->string('cep', 10);
            $table->string('endereco', 100);
            $table->string('numero');
            $table->string('complemento', 100);
            $table->string('bairro', 60);
            $table->string('cidade', 60);
            $table->string('estado', 30);
            $table->string('telefone', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores');
    }
}
