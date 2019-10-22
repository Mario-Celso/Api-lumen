<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ticket_status_id');
            $table->integer('customer_id');
            $table->integer('contact_id');
            $table->integer('suport_department_id');
            $table->timestamp('opened_at');
            $table->string('subject');
            $table->string('message');
            $table->timestamp('closed_at');
            $table->string('additional_comments')->nullable();

            $table->foreign('ticket_status_id')->references('id')->on('tickets_status');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('suport_department_id')->references('id')->on('suport_departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
