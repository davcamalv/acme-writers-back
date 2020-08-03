<?php

use App\Models\Ticker;
use Illuminate\Database\Seeder;

class TickerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticker = new Ticker(['identifier' => '12122020-ticker1111']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2222']);
        $ticker->save();

        $ticker = new Ticker(['identifier' => '12122020-ticker2223']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2224']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2225']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2226']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2227']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2228']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2229']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2210']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2211']);
        $ticker->save();
        $ticker = new Ticker(['identifier' => '12122020-ticker2212']);
        $ticker->save();
    }
}
