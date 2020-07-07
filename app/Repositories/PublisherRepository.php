<?php

namespace App\Repositories;

use App\Dtos\RegisterPublisherDto;
use App\Models\CreditCard;
use App\Models\User;
use App\Models\Publisher;
use App\Models\Role;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class PublisherRepository {

    protected $creditCardRepository;

    public function __construct(CreditCardRepository $creditCardRepo){
        $this->creditCardRepository = $creditCardRepo;
    }

    public function getModel(){
        return new Publisher();
    }

    public function save(array $data){
        $this->validateDataToSave($data);
        $credit_card = $this->creditCardRepository->save($data['credit_card']);
        $user = new User($data);
        $user -> setAttribute('password', bcrypt($data['password']));
        $publisher = new Publisher($data);
        CreditCard::find($credit_card->getId())->publisher()->save($publisher);
        $publisher->save();
        $publisher->user()->save($user);
        $user->save();
        $user->roles()->attach(Role::where('name', 'publisher')->first());

        return new RegisterPublisherDto($user->id, $user->name, $user->email, $user->address, $user->phone_number, $publisher->VAT, $publisher->comercial_name, $credit_card);
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['name'=>'required', 'email' => 'required|email|unique:users,email', 'password' => 'required', 'VAT'=>'required' , 'comercial_name'=>'required' , 'credit_card'=>'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }
}
