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
        $book->setAttribute('status', 'INDEPENDENT');
        $book->setAttribute('draft', true);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(1)->first();
        $book = new Book(["title"=>"book2", "description"=>"description2", "language"=>"EN", "genre"=>"ROMANCE", "cover"=>"https://cover2.com"]);
        $book->setAttribute('status', 'PENDING');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', true);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);


        $ticker = Ticker::all()->skip(2)->first();
        $book = new Book(["title"=>"Harry Potter and the Goblet of Fire", "description"=>"Harry Potter and the Goblet of Fire", "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i1.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/caliz-fuego-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(3)->first();
        $book = new Book(["title"=>"Harry Potter and the Chamber of Secrets", "description"=>"Harry Potter and the Chamber of Secrets", "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i0.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/camara-secreta-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(4)->first();
        $book = new Book(["title"=>"Harry Potter and the Order of the Phoenix", "description"=>"Harry Potter and the Order of the Phoenix", "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i2.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/orden-fenix-reino-unido-2.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(5)->first();
        $book = new Book(["title"=>"Harry Potter and the Philosopher's Stone", "description"=>"Harry Potter and the Philosopher's Stone", "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i2.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/piedra-filosofal-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(6)->first();
        $book = new Book(["title"=>"Harry Potter and the Half-Blood Prince", "description"=>"Harry Potter and the Half-Blood Prince", "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i1.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/principe-mestizo-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(7)->first();
        $book = new Book(["title"=>"Fantastic beasts", "description"=>"Fantastic beasts", "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://img.milanuncios.com/fg/2780/22/278022104_1.jpg?VersionId=3VVlEgMEjSzXCx0X7hh69CkdhB4hgyaf"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(8)->first();
        $book = new Book(["title"=>"Harry Potter and the Prisoner of Azkaban", "description"=>"Harry Potter and the Prisoner of Azkaban", "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i2.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/prisionero-azkaban-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(9)->first();
        $book = new Book(["title"=>"Harry Potter and the Deathly Hallows", "description"=>"Harry Potter and the Deathly Hallows", "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i2.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/reliquias-muerte-reino-unido-2.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(10)->first();
        $book = new Book(["title"=>"Harry Potter and the Cursed Child 1", "description"=>"Harry Potter and the Cursed Child 1", "language"=>"EN", "genre"=>"ADVENTURE"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(11)->first();
        $book = new Book(["title"=>"Harry Potter and the Cursed Child 2", "description"=>"Harry Potter and the Cursed Child 2", "language"=>"EN", "genre"=>"ADVENTURE"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

    }
}
