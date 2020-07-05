<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('keyword')->nullable();
            $table->string('language')->nullable();
            $table-> date('last_update')->nullable();
            $table->enum('genre', ['FANTASY', 'ADVENTURE', 'THRILLER', 'ROMANCE', 'MYSTERY'])->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finders');
    }
}
