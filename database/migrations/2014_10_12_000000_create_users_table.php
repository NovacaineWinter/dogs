<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('dogName');
            $table->integer('dogSize');
            $table->string('lineOne');
            $table->string('lineTwo')->nullable();
            $table->string('lineThree')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('postcode');
            $table->string('stripe_id');
            $table->integer('account_status')->default(0);
            $table->boolean('subscribed_to_mailchimp')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
            
            //take care of orphaned tables/ideas
        Schema::dropIfExists('stripe_requests');
        Schema::dropIfExists('stripe_subscriptions');
    }
}
