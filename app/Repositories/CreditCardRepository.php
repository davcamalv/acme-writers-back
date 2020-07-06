<?php

namespace App\Repositories;

use App\Dtos\CreditCardDto;
use App\Models\CreditCard;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class CreditCardRepository {

    public function getModel(){
        return new CreditCard();
    }

    public function save(array $data){
        $this->validateDataToSave($data);
        $credit_card = new CreditCard($data);
        $credit_card->save();
        return new CreditCardDto($credit_card->id, $credit_card->holder, $credit_card->make, $credit_card->number, $credit_card->expiration_month, $credit_card->expiration_year, $credit_card->cvv);
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['holder'=>'required', 'make' => 'required',
         'number' => 'required', 'expiration_month'=>'required|numeric|between:1,12', 'expiration_year'=>'required|numeric|min:0', 'cvv'=>'required|numeric|between:100,999']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }
}
