<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\JWTRepository;

class TokenController extends Controller
{
    protected $JWTRepository;

    public function __construct(JWTRepository $JWTRepo){
        $this->JWTRepository = $JWTRepo;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
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
