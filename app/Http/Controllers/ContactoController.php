<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        if(session('usuario') && session('usuario')['login'])
        {
            return redirect()->to('/home');
        }

        $data['configinfo']  = $this->configinfo();

        return view('contacto' , $data);
    }
}
