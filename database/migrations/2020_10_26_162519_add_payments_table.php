<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->integer("amount");
            $table->integer("attachment_id")->nullable();
            $table->foreignId("bill_id");
            $table->foreign("bill_id")->references("id")->on("bills");
            $table->string("description")->nullable();
            $table->string("recurring")->nullable();
            $table->string("payment_method");
            $table->foreignId("account_id");
            $table->foreign('account_id')->references('id')->on('accounts');
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
       Schema::dropIfExists('payments');
    }
}
