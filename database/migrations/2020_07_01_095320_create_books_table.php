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
            $table->enum('language',['EN', 'ES', 'IT', 'FR', 'DE', 'OTHER']);
            $table->string('cover')->nullable();
            $table->enum('status', ['INDEPENDENT', 'PENDING', 'REJECTED', 'ACCEPTED']);
            $table->boolean('draft');
            $table->foreignId('ticker_id')->constrained();
            $table->enum('genre', ['FANTASY', 'TERROR', 'ADVENTURE', 'BIOGRAPHICAL', 'SCIENCE_FICTION', 'CRIME', 'ROMANCE', 'MYSTERY'])->nullable();
            $table->foreignId('publisher_id')->nullable()->constrained();
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
