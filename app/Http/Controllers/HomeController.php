<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoModel;
use App\Models\ImagenesModel;
use App\Models\ImagenReferenciaModel;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if(session('usuario') && session('usuario')['login'])
        {
            return redirect()->to('/home');
        }
        
        $data['productos']  = ProductoModel::select('productos.*', 'imagen_referencia.imagen as imagen')
                                            ->join('imagen_referencia' , 'imagen_referencia.idproducto' , '=' , 'productos.id')
                                            ->where('estado' , '1')
                                            ->latest()
                                            ->take(5)
                                            ->orderBy('productos.id' , 'ASC')
                                            ->get();

        $data['configinfo']  = $this->configinfo();                          
        return view('home' , $data);
    }


    public function catalogo()
    {
        $data['productos']          = ProductoModel::select('productos.*', 'imagen_referencia.imagen as imagen')
                                            ->join('imagen_referencia' , 'imagen_referencia.idproducto' , '=' , 'productos.id')
                                            ->where('estado' , '1')
                                            ->simplePaginate(4);

        $total_productos            = ProductoModel::select('productos.*', 'imagen_referencia.imagen as imagen')
                                            ->join('imagen_referencia' , 'imagen_referencia.idproducto' , '=' , 'productos.id')
                                            ->where('estado' , '1')
                                            ->get(4);

        $data['productos_pagina']   = count($data['productos']);
        $data['total_productos']    = count($total_productos);
        $data['configinfo']         = $this->configinfo();

        return view('catalogo'  , $data);
    }


    public function detalle($id)
    {
        $data['producto']           =   ProductoModel::select('productos.*', 'imagen_referencia.imagen as imagen')
                                            ->join('imagen_referencia' , 'imagen_referencia.idproducto' , '=' , 'productos.id')
                                            ->where('productos.estado' , '1')
                                            ->where('productos.id' , $id)
                                            ->first();

        $data['imagenes']           =   ImagenesModel::where('idproducto' , $id)->get();
        $data['configinfo']         = $this->configinfo();

        return view('detalle'   ,   $data);
    }


    public function agregarproducto(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }   

        $id         = $request->input('id');
        $cantidad   = $request->input('cantidad');

        if(!$this->agregar_productocarrito($id , $cantidad))
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'No se pudo agregar']);
            return;
        }

        echo json_encode(['estado' => TRUE , 'mensaje' => 'Producto agregado con éxito']);
    }



    public function buscar_producto(Request $request)
    {
        $busqueda            = $request->input('busqueda');
        $data['resultados']  = ProductoModel::select('productos.*', 'imagen_referencia.imagen as imagen')
                                            ->join('imagen_referencia' , 'imagen_referencia.idproducto' , '=' , 'productos.id')
                                            ->where('estado' , '1')
                                            ->where('nombre' , 'like' , "%$busqueda%")
                                            ->get();

       $data['configinfo']  = $this->configinfo();
        return view('resultado' , $data);;
    }

}
