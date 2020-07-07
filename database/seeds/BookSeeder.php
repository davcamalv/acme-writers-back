<?php

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Ticker;
use App\Models\Writer;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticker = Ticker::all()->first();
        $book = new Book(["title"=>"book1", "description"=>"description1", "language"=>"ES", "genre"=>"MYSTERY", "cover"=>"https://cover1.com"]);
        $book->setAttribute('cancelled', false);
        $book->setAttribute('status', 'INDEPENDENT');
        $book->setAttribute('draft', true);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(1)->first();
        $book = new Book(["title"=>"book2", "description"=>"description2", "language"=>"EN", "genre"=>"ROMANCE", "cover"=>"https://cover2.com"]);
        $book->setAttribute('cancelled', false);
        $book->setAttribute('status', 'PENDING');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', true);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

    }
}
