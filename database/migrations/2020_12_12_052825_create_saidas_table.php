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
    public function up(){
        Schema::create('saidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('produto_id')->unsigned()->nullable();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->string('validade_produto')->nullable();
            $table->double('preco_un', 8, 2);
            $table->double('preco_saida', 8, 2);
            $table->integer('quantidade');
            $table->boolean('is_excluded')->default(false);
            $table->dateTime('deleted_at')->nullable();
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
