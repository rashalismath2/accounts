<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->float("amount");
            $table->foreignId("account_id");
            $table->foreignId("customer_id");
            $table->foreign("account_id")->references("id")->on("accounts");
            $table->foreign("customer_id")->references("id")->on("customers");
            $table->string("description");
            $table->string("recurring");
            $table->string("payment_method");
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
        Schema::dropIfExists('revenues');
    }
}
