<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status_id');
            $table->integer('city_id');
            $table->boolean('active')->default(true);
            $table->string('trade_name');
            $table->string('company_name')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('federal_tax_id',14)->nullable();
            $table->string('state_tax_id')->nullable();
            $table->string('city_tax_id')->nullable();
            $table->date('creationing_date')->nullable();
            $table->date('opening_date')->nullable();
            $table->double('balance', 10,2 );
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('address_number')->nullable();
            $table->string('zipcode',8)->nullable();

            $table->string('note')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at')->nullable();


            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('status_id')->references('id')->on('status');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
