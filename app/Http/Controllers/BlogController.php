<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel;

class BlogController extends Controller
{
    public function index()
    {
        if(session('usuario') && session('usuario')['login'])
        {
            return redirect()->to('/home');
        }
        
        $data['comentarios'] = BlogModel::where('estado' , 1)
                                        ->orderBy('id' , 'DESC')
                                        ->simplePaginate(2);
        $data['configinfo']  = $this->configinfo();
        
        return view('blog'   , $data);
    }


    public function agregar_comentario(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }

        $nombre     = trim($request->input('nombre'));
        $email      = trim($request->input('email'));
        $comentario = trim($request->input('comentario'));

        if(!filter_var($email , FILTER_VALIDATE_EMAIL))
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'El email ingresado no es válido']);
            return;
        }


        if(strlen($comentario) > 255)
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Solo se permiten máximo 255 caracteres']);
            return;
        }


        $data_comentario    =
        [
            'nombre'        => $nombre,
            'email'         => $email,
            'comentario'    => $comentario,
            'fecha'         => date('Y-m-d'),
            'estado'        => 0
        ];

        if(!BlogModel::insert($data_comentario))
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'No se pudo registrar su comentario']);
            return;
        }

        echo json_encode(['estado' => TRUE, 'mensaje' => 'Gracias, pronto su opinión se podrá visualizar']);
    }

}
