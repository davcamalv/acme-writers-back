<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('description');
            $table->string('language');
            $table->string('cover')->nullable();
            $table->boolean('cancelled');
            $table->enum('status', ['INDEPENDENT', 'PENDING', 'REJECTED', 'ACCEPTED']);
            $table->boolean('draft');
            $table->double('score');
            $table->foreignId('ticker_id')->constrained();
            $table->enum('genre', ['FANTASY', 'ADVENTURE', 'THRILLER', 'ROMANCE', 'MYSTERY'])->nullable();
            $table->foreignId('publisher_id')->constrained();
            $table->foreignId('writer_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
