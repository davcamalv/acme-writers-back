<?php

namespace App\Repositories;

use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTRepository {

    public function login(array $credentials){
        $res = null;

        $token = JWTAuth::attempt($credentials);

        if ($token) {
            $res = response()->json(['token' => $token], 200);
        } else {
            $res = response()->json(['message' => 'Wrong credentials'], 401);
        }
        return $res;
    }

    public function refreshToken(){
        $res = null;

        $token = JWTAuth::getToken();

        try {
            $token = JWTAuth::refresh($token);
            $res = response()->json(['token' => $token], 200);
        } catch (Exception $e){
            $res = response()->json(['success' => false, 'message' => 'Need to login again, please!'], 400);
        }
        return $res;
    }

    public function logout(){
        $res = null;

        $token = JWTAuth::getToken();

        try {
            $token = JWTAuth::invalidate($token);
            $res = response()->json(['success' => true, 'message' => "You have successfully logged out."], 200);
        } catch (Exception $e) {
            $res = response()->json(['success' => false, 'message' => 'Failed to logout, please try again.'], 422);
        }
        return $res;
    }
}
