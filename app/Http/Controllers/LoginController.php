<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class LoginController extends Controller
{
    public function index()
    {
        if(session('usuario') && session('usuario')['login'])
        {
            return redirect()->to('/home');
        }

        return view('login');
    }

    public function login_sesion(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }

        $usuario    = $request->input('usuario');
        $clave      = $request->input('clave');
        $comprobar  = UserModel::where('email' , $usuario)
                                ->where('password' , $clave)
                                ->first();

        if(!filter_var($usuario, FILTER_VALIDATE_EMAIL))
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'El email ingresado no es válido']);
            return;
        }

        if($comprobar == NULL)
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Los datos no coinciden']);
            return;            
        }


        $usuario    = 
        [
            'idusuario' => $comprobar->id,
            'nombre'    => $comprobar->name,
            'email'     => $comprobar->email,
            'login'     => true
        ];

        $request->session()->put('usuario' , $usuario);;
        echo json_encode(['estado' => TRUE]);

    }


    public function cerrar_sesion(Request $request)
    {
        $request->session()->forget('usuario');
        return redirect()->to('/');
    }   
}
