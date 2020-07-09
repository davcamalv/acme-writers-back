<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(CreditCardSeeder::class);
        $this->call(WriterSeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(TickerSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(ReaderSeeder::class);



    }
}
