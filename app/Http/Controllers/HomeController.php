<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    var $request;
    var $model;
    var $folder='';
    var $path;
    public function __construct(Request $request) {
       $this->request = $request;
       $this->model = new User();
       $this->path = str_replace('.','/',$this->folder);
    }

    public function index($index=0) {
       return view($this->folder.'.index',[
        'jsControllers'=>[
          0 => 'app'.$this->path.'/HomeController.js',
        ],
        'cssStyles' => [
            0 => 'app'.$this->path.'/style.css'
        ]
       ]);
    }

    public function login() {
      if (Auth::attempt($this->request->only('email','password'))) {
          return $this->successResponse([
            'err' => false,
            'message' => 'Acceso correcto'
          ]);
      } else {
        return $this->errorResponse([
          'err' => true,
          'message' => 'Datos de acceso incorrectos.'
        ]);
      }
    }

    public function logout() {
      Auth::logout();
      return redirect(route('login'));
    }
}
