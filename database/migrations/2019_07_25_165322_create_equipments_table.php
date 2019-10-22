<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->integer('product_producers_id');
            $table->integer('product_models_id');
            $table->date('installed_at');
            $table->string('description')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('product_producers_id')->references('id')->on('product_producers');
            $table->foreign('product_models_id')->references('id')->on('product_models');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipments');
    }
}
