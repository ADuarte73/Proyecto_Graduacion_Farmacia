<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NosotrosController extends Controller
{
    public function index()
    {
        $data['configinfo']  = $this->configinfo();
        return view('nosotros' , $data);
    }
}
