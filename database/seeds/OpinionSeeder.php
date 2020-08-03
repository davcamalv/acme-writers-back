<?php

use App\Models\Book;
use App\Models\Opinion;
use App\Models\Reader;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OpinionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = Book::all()->skip(2)->first();
        $opinion = new Opinion(["positive"=>true, "review"=>"This is my favorite Harry Potter book. I've read it several times!", "date"=>Carbon::parse('2000-01-01')]);
        $opinion->setAttribute('book_id', $book->id);
        $reader = Reader::all()->first();
        $reader->opinions()->save($opinion);
    }
}
