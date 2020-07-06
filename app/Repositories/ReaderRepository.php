<?php

namespace App\Repositories;

use App\Dtos\RegisterReaderDto;
use App\Models\Finder;
use App\Models\User;
use App\Models\Reader;
use App\Models\Role;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class ReaderRepository {


    public function getModel(){
        return new Reader();
    }

    public function save(array $data){
        $this->validateDataToSave($data);
        $user = new User(['name'=>$data['name'], 'email'=>$data['email'], 'password'=>bcrypt($data['password']), 'address'=>$data['address'], 'phone_number'=>$data['phone_number']]);
        $reader = new Reader();
        $finder = new Finder();
        $finder->save();
        $finder->reader()->save($reader);
        $reader->save();
        $reader->user()->save($user);
        $user->save();
        $user->roles()->attach(Role::where('name', 'reader')->first());

        return new RegisterReaderDto($user->id, $user->name, $user->email, $user->address, $user->phone_number);
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['name'=>'required', 'email' => 'required|email|unique:users,email', 'password' => 'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }
}
