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
            $table->bigIncrements('id');
            $table->boolean('active')->default(true);
            $table->boolean('logged');
            $table->string('full_name');
            $table->string('email');
            $table->string('role');
            $table->string('access_user');
            $table->string('pass_user');
            $table->string('national_card_id_1')->nullable();
            $table->string('national_card_id_2')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('address_number')->nullable();
            $table->string('phone_1', 11)->nullable();
            $table->string('phone_2', 11)->nullable();
            $table->string('zipcode', 8)->nullable();
            $table->integer('city_id');
            $table->string('notes')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('disabled_at')->nullable();
            $table->timestamp('last_activity_on');


            $table->foreign('city_id')->references('id')->on('cities');


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
    }
}
