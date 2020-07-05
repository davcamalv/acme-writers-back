<?php

namespace App\Http\Controllers;

use App\Repositories\JWTRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokenController extends Controller
{
    protected $JWTRepository;

    public function __construct(JWTRepository $JWTRepo){
        $this->JWTRepository = $JWTRepo;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, ['email' => 'required|email', 'password' => 'required']);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Wrong validation', 'errors' => $validator->errors()], 422);
        }
        return $this->JWTRepository->login($credentials);
    }

    public function refreshToken()
    {
        return $this->JWTRepository->refreshToken();
    }

    public function logout()
    {
        return $this->JWTRepository->logout();
    }
}
