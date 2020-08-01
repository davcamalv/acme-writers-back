<?php

namespace App\Repositories;

use App\Dtos\RegisterReaderDto;
use App\Models\User;
use App\Models\Reader;
use App\Models\Role;
use DateTime;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReaderRepository {


    public function getModel(){
        return new Reader();
    }

    public function save(array $data){
        $this->validateDataToSave($data);
        $user = new User($data);
        $user -> setAttribute('password', bcrypt($data['password']));
        $reader = new Reader();
        $reader->save();
        $reader->user()->save($user);
        $user->roles()->attach(Role::where('name', 'reader')->first());

        $token = JWTAuth::attempt(array('email'=>$data['email'], 'password' => $data['password']));
        return response()->json(['token' => $token], 200);
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['name'=>'required', 'email' => 'required|email|unique:users,email', 'password' => 'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }
}
