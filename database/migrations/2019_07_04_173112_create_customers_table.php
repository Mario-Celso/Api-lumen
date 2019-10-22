<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('city_id');
            $table->integer('status_id');
            $table->boolean('active')->default(true);
            $table->double('balance',10,2);
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('address_number')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('notes')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at')->nullable();
            $table->string('name')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('nickname')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('state_tax_id')->nullable();
            $table->string('city_tax_id')->nullable();

            $table->foreign('status_id')->references('id')->on('status');
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
        Schema::dropIfExists('customers');
    }
}
