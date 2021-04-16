<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
class AuthController extends Controller
{
    var $request;
    var $model;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->model = new User();
    }

    public function login() {
        if(!Auth::attempt($this->request->only('email','password'))) {
            return response([
                'err' => true,
                'message' => 'Datos de acceso incorrectos'
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt',$token,60*24);//1 day
        unset($user->password);
        return response([
            'message' => 'Success',
            'token' => $token,
            'user' => $user
        ])->withCookie($cookie);
    }

    public function logout() {
        $cookie = Cookie::forget('jwt');
        return response([
            'err'=> false,
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
