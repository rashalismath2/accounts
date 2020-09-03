<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string("acc_name");
            $table->string("acc_number");
            $table->foreignId("currency_id");
            $table->foreignId("user_id");
            $table->foreignId("currency_id")->references("id")->on("currencies");
            $table->foreign("user_id")->references("id")->on("users");
            $table->float("opening_balance");
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
        Schema::dropIfExists('accounts');
    }
}
