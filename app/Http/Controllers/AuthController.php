<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\UserLoginRequest;


class AuthController extends Controller
{
    public $token = true;
    private $userObj = "";
    function __construct()
    {
        
        $this->userObj = new User();
    }

    public function login(UserLoginRequest $request)
    {
  
        $jwt_token = null;
        $jwt_token = $this->userObj->authenticteUser($request);
        if (!$jwt_token) {
            return apiResponse(null, 'errors', 'Invalid email or password', '', '');
        } else {
            $currentUser = Auth::user();
            return apiResponse(null, 'success', 'User successfully logged in', $jwt_token, auth()->user());
        }
    }
    public function logout(Request $request)
    {
        JWTAuth::invalidate($request->token);
        return apiResponse(null, 'success', 'User successfully logged out', '', '');
    }
   
}