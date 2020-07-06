<?php

namespace App\Repositories;

use App\Dtos\RegisterWriterDto;
use App\Models\CreditCard;
use App\Models\Role;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

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
        $user = new User(['name'=>$data['name'], 'email'=>$data['email'], 'password'=>bcrypt($data['password']), 'address'=>$data['address'], 'phone_number'=>$data['phone_number']]);
        $writer = new Writer();
        CreditCard::find($credit_card->getId())->writer()->save($writer);
        $writer->save();
        $writer->user()->save($user);
        $user->save();
        $user->roles()->attach(Role::where('name', 'writer')->first());

        return new RegisterWriterDto($user->id, $user->name, $user->email, $user->address, $user->phone_number, $credit_card);
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['name'=>'required', 'email' => 'required|email|unique:users,email', 'password' => 'required', 'credit_card'=>'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }
}
