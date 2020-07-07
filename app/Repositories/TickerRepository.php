<?php

namespace App\Repositories;

use App\Models\Ticker;
use DateTime;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class TickerRepository {

    public function getModel(){
        return new Ticker();
    }

    public function generateTicker(){
        $current_date = new DateTime();
        $string_date =  $current_date->format('dmY');
        $identifier = $string_date . "-";
        $alfanumeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i < 10; $i++) {
            $random_number = random_int(0, strlen($alfanumeric) - 1);
            $identifier = $identifier . $alfanumeric{$random_number};
        }
        $ticker = new Ticker(['identifier' => $identifier]);
        $ticker->save();
        return $ticker;
    }

}
