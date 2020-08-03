<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class UserRepository {

    public function isAValidEmail(array $data){
        $this->validateDataEmail($data);
        return User::where('email', $data['email'])->exists();
    }

    private function validateDataEmail(array $data){
        $validator = Validator::make($data, ['email' => 'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }

}
