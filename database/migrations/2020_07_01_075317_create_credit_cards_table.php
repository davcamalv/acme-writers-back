<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('holder')->required();
            $table->string('make')->required();
            $table->string('number')->required();
            $table->integer('expiration_month')-> range(1, 12)->required();
            $table->integer('expiration_year')-> min(0) ->required();
            $table->integer('cvv')-> range(100, 999)->required();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_cards');
    }
}
