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
        $book = new Book(["title"=>"Harry Potter and the Goblet of Fire",
        "description"=>"Hogwarts is preparing for the Three Wizards Tournament, in which three schools of sorcery will compete. To everyone's surprise, Harry Potter is chosen to take part in the competition, where he will have to fight dragons, go into the water and face his greatest fears.",
        "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i1.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/caliz-fuego-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(3)->first();
        $book = new Book(["title"=>"Harry Potter and the Chamber of Secrets",
        "description"=>"Harry Potter and the sophomores investigate a malicious threat to their Hogwarts classmates.",
        "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i0.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/camara-secreta-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(4)->first();
        $book = new Book(["title"=>"Harry Potter and the Order of the Phoenix",
        "description"=>"In his fifth year at Hogwarts, Harry discovers that many in the wizard community do not know the truth about his encounter with Lord Voldemort. Cornelius Fudge, Minister of Magic, appoints Dolores Umbridge as a teacher of defence against the dark arts because he believes Professor Dumbledore plans to take over her work. But her teaching is inadequate, so Harry prepares students to defend the school against evil.",
        "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i2.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/orden-fenix-reino-unido-2.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(5)->first();
        $book = new Book(["title"=>"Harry Potter and the Philosopher's Stone",
        "description"=>"On his birthday, Harry Potter discovers that he is the son of two well-known sorcerers, from whom he has inherited magical powers. He must attend a famous school of magic and sorcery, where he makes friends with two young men who will become his fellow adventurers. During his first year at Hogwarts, he discovers that a malevolent and powerful wizard named Voldemort is in search of a philosopher's stone that will prolong the life of its owner.",
        "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i2.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/piedra-filosofal-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(6)->first();
        $book = new Book(["title"=>"Harry Potter and the Half-Blood Prince",
        "description"=>"Harry discovers a powerful book and, while trying to discover its origins, collaborates with Dumbledore in the search for a series of magical objects that will help in the destruction of Lord Voldemort.",
        "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i1.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/principe-mestizo-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(7)->first();
        $book = new Book(["title"=>"Fantastic beasts",
        "description"=>"In 1926, zoological expert magician Newt Scamander makes a brief stop in New York while he travels around the world cataloguing and capturing magical creatures. Jacob, an ordinary human, mistakenly causes the creatures to escape and hide around the city. Scamander will have to catch them again, before they cause trouble.",
        "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://img.milanuncios.com/fg/2780/22/278022104_1.jpg?VersionId=3VVlEgMEjSzXCx0X7hh69CkdhB4hgyaf"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(8)->first();
        $book = new Book(["title"=>"Harry Potter and the Prisoner of Azkaban",
        "description"=>"Harry's third year at Hogwarts is threatened by Sirius Black's escape from Azkaban prison. Apparently, he is a dangerous wizard who was an accomplice of Lord Voldemort and who will try to take revenge on Harry Potter.",
        "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i2.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/prisionero-azkaban-reino-unido-3.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(9)->first();
        $book = new Book(["title"=>"Harry Potter and the Deathly Hallows",
        "description"=>"Harry, Ron and Hermione leave Hogwarts to begin their most important mission: they must destroy the horcruxes, the secret of Voldemort's power and immortality, in which the dreaded dark wizard holds the fragments of his soul.",
        "language"=>"EN", "genre"=>"ADVENTURE", "cover"=>"https://i2.wp.com/www.bloghogwarts.com/wp-content/uploads/2011/02/reliquias-muerte-reino-unido-2.jpg"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(10)->first();
        $book = new Book(["title"=>"Harry Potter and the Cursed Child 1",
        "description"=>"Nineteen years after Harry Potter left Hogwarts School for Magic, the famous wizard is now a hard-working employee of the Ministry for Magic and father to three teenaged children. Magic and making friends do not come naturally to him and he finds himself miserable at his new school, Hogwarts.",
        "language"=>"EN", "genre"=>"ADVENTURE"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

        $ticker = Ticker::all()->skip(11)->first();
        $book = new Book(["title"=>"Harry Potter and the Cursed Child 2",
        "description"=>"After attempting to rectify their mistakes and change history once more, Albus Potter does not emerge from their time-travel and Scorpius Malfoy finds himself trapped in a hideous alternative reality where Lord Voldemort rules and Harry Potter is dead.",
        "language"=>"EN", "genre"=>"ADVENTURE"]);
        $book->setAttribute('status', 'ACCEPTED');
        $book->setAttribute('publisher_id', Publisher::all()->first()->id);
        $book->setAttribute('draft', false);
        $book->setAttribute('ticker_id', $ticker->id);
        $writer = Writer::all()->first();
        $writer->books()->save($book);

    }
}
