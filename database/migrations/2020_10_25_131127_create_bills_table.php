<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id');
            $table->foreignId('currency_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->date("bill_date");
            $table->date("due_date");
            $table->string("bill_number");
            $table->string("order_number");
            $table->string("attachment_id");
            $table->string("notes");
            $table->integer("total");
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
        Schema::dropIfExists('bills');
    }
}
