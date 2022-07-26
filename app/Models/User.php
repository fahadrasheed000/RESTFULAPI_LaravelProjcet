<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use DB;
use JWTAuth;

use Illuminate\Support\Arr;

class User extends Authenticatable implements JWTSubject
{

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function authenticteUser($request)
    {
        $jwt_token = JWTAuth::attempt($request->validated());
        return $jwt_token;
    }


}
