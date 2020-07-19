<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepo){
        $this->userRepository = $userRepo;
    }

    public function isAValidEmail(Request $request)
    {
        return $this->userRepository->isAValidEmail($request->all());
    }
}
