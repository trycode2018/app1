<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
    }

    public function register(){

        $validator = validator()->make(request()->all(),[
            'name'=>'string|required',
            'email'=>'string|required',
            'password'=>'string|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Registration fail'
            ]);
        }
        $user = User::create([
            'name'=> request()->get('name'),
            'email'=>request()->get('email'),
            'password'=> bcrypt(request()->get('password'))
        ]);
        return response()->json(
            [
                'message'=>'User Created',
                'user' => $user
            ]
        );
    }

    public function login(){
        $credentials = request(['email','password']);

        if(! $token = JWTAuth::attempt($credentials)){
            return response()->json(['error'=>'Unauthorized'],401);
        }

        return $this->respondWithToken($token);
    }

    public function me(){
        return response()->json(auth()->user());
    }

    public function logout(){
        auth()->logout();

        return response()->json(['message'=>'Successfuly logged out']);
    }

    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=> 'bearer',
            'expires_in'=> config('jwt.ttl')
        ]);
    }

}


