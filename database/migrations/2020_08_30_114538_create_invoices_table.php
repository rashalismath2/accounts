<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id");
            $table->foreignId("currency_id");
            $table->foreign("customer_id")->references("id")->on("customers");
            $table->foreign("currency_id")->references("id")->on("currencies");
            $table->date("invoice_date");
            $table->date("due_date");
            $table->string("invoice_number");
            $table->string("order_number");
            $table->string("notes");
            $table->string("recurring");
            $table->string("file_id");
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
        Schema::dropIfExists('invoices');
    }
}
