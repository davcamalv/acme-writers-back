<?php

namespace App\Repositories;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTRepository {

    public function login(array $credentials){
        $res = null;

        $validator = $credentials->validate(['email' => 'required|email', 'password' => 'required']);

        if ($validator->fails()) {
            $res = response()->json(['success' => false, 'message' => 'Wrong validation', 'errors' => $validator->errors()], 422);
        }

        $token = JWTAuth::attempt($credentials);

        if ($token) {
            $res = $token;
        } else {
            $res = response()->json(['message' => 'Wrong credentials', 'errors' => 401]);
        }
        return $res;
    }

    public function refreshToken(){
        $res = null;

        $token = JWTAuth::getToken();

        try {
            $token = JWTAuth::refresh($token);
            $res = $token;
        } catch (TokenExpiredException $ex) {
            return response()->json(['success' => false, 'message' => 'Need to login again, please (expired)!'], 400);
        } catch (TokenBlacklistedException $ex) {
            return response()->json(['success' => false, 'message' => 'Need to login again, please (blacklisted)!'], 422);
        }
        return $res;
    }

    public function logout(){
        $res = null;

        $token = JWTAuth::getToken();

        try {
            $token = JWTAuth::invalidate($token);
            $res = response()->json(['code' => 5, 'success' => true, 'message' => "You have successfully logged out."], 200);
        } catch (JWTException $e) {
            $res = response()->json(['code' => 6, 'success' => false, 'message' => 'Failed to logout, please try again.'], 422);
        }
        return $res;
    }
}
