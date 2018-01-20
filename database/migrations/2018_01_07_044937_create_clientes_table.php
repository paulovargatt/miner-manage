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
            $table->double('power_miner',10,2);
            $table->decimal('balance',16,6)->default('0.000000');
            $table->text('desc')->nullable();
            $table->timestamp('date_plan')->nullable()->default('2020-01-01 00:02:00');
            $table->timestamp('date_pagamento')->nullable()->default('2019-01-01 00:02:00');
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
