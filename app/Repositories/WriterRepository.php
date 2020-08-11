<?php

namespace App\Repositories;

use App\Dtos\RegisterWriterDto;
use App\Models\CreditCard;
use App\Models\Role;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class WriterRepository {

    protected $creditCardRepository;

    public function __construct(CreditCardRepository $creditCardRepo){
        $this->creditCardRepository = $creditCardRepo;
    }

    public function getModel(){
        return new Writer();
    }

    public function save(array $data){
        $this->validateDataToSave($data);
        $credit_card = $this->creditCardRepository->save($data['credit_card']);
        $user = new User($data);
        $user -> setAttribute('password', bcrypt($data['password']));
        $writer = new Writer();
        CreditCard::find($credit_card->getId())->writer()->save($writer);
        $writer->save();
        $writer->user()->save($user);
        $user->save();
        $user->roles()->attach(Role::where('name', 'writer')->first());
        $token = JWTAuth::attempt(array('email'=>$data['email'], 'password' => $data['password']));
        return response()->json(['token' => $token], 200);
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['name'=>'required', 'email' => 'required|email|unique:users,email', 'password' => 'required', 'credit_card'=>'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }
}
