<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('produto_id')->unsigned()->nullable();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->integer('quantidade');
            $table->decimal('preco_un', 19,2); 
            $table->date('data_saida');
            $table->string('observacoes', 4000);
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
        Schema::dropIfExists('saidas');
    }
}
