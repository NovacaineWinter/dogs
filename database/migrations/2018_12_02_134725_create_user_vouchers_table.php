<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_code')->default('');
            $table->boolean('is_redeemed')->default(false);
            $table->integer('voucher_id');
            $table->string('giver_email');
            $table->integer('redeemer_id')->nullable();
            $table->integer('price');
            $table->integer('num_of_boxes');
            $table->boolean('expired')->default(false);
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('user_vouchers');
    }
}
