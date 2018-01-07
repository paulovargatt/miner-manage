<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('coin_id')->unsigned();
            $table->foreign('coin_id')->references('id')->on('moedas')->onDelete('cascade');
            $table->integer('power_miner')->nullable();
            $table->double('balance',10,2)->default(0);
            $table->text('desc');
            $table->timestamp('date_plan');
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
        Schema::dropIfExists('clientes');
    }
}
