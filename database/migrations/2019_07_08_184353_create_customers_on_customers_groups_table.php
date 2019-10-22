<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersOnCustomersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_on_customers_groups', function (Blueprint $table) {
            $table->integer('customer_id');
            $table->integer('customer_group_id');


            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('customer_group_id')->references('id')->on('customers_groups');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers_on_customers_groups');
    }
}
