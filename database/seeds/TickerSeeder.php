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
    }
}
