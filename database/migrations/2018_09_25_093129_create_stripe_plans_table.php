<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname');
            $table->integer('product_id');
            $table->integer('amount');
            $table->string('price_string');
            $table->string('currency');
            $table->string('interval');
            $table->string('stripe_id');
            $table->boolean('active');
            $table->string('title');
            $table->string('description');
            $table->string('img');
            $table->string('size');
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
        Schema::dropIfExists('stripe_plans');
    }
}
