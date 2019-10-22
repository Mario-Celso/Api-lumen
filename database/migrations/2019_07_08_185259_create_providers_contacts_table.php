<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provider_id');
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();


            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers_contacts');
    }
}
