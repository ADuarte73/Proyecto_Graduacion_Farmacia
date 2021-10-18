<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\ConfiguracionModel;
use App\Models\OrdenesModel;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        if(!session('usuario')['login'])
        {
            return redirect()->to('/');
        }


        $data['ordenes']     = OrdenesModel::count();
        $data['comentarios'] = BlogModel::count();
        $data['totales']     = OrdenesModel::sum('total');;

        return view('admin.home' , $data);
    }

    public function blog()
    {
        if(!session('usuario')['login'])
        {
            return redirect()->to('/');
        }

        $data['comentarios'] = BlogModel::get();
        return view('admin.blog' , $data);
    }

    public function obtener_comentarios()
    {
        $comentarios          = BlogModel::get();

        return Datatables()
                            ->of($comentarios)
                            ->addIndexColumn(2)
                            ->addColumn('opciones', function($comentarios) {
                                $idproducto = $comentarios->id;
                                $estado = $comentarios->estado;
                                if($estado == '1')
                                {
                                    $btn  = '<input type="checkbox" class="form-control btn_cambiarestado" checked data-toggle="tooltip" title="Aprobar comentario" style="cursor: pointer;" data-id="'.$idproducto.'" data-check="0">';
                                }
                                else {
                                    $btn  = '<input type="checkbox" class="form-control btn_cambiarestado" data-toggle="tooltip" title="Aprobar comentario" style="cursor: pointer;" data-id="'.$idproducto.'" data-check="1">';
                                }
                                
                                return $btn;
                            })
                            ->addColumn('estado', function($comentarios) {
                                $estado = $comentarios->estado;
                                if($estado == '1')
                                {
                                    $btn = '<span class="badge badge-primary">Mostrando</span>';
                                }
                                else {
                                    $btn = '<span class="badge badge-danger">Oculto</span>';
                                }

                                return $btn;
                            })
    
                            ->rawColumns(['opciones' , 'estado'])
                            ->make(true);
    }


    public function actualizar_check(Request $request)
    {

        $id        = (int) $request->input('id');
        $check     = (int) $request->input('check') == 1 ? 1 : 0;


        $data_blog =
        [
            'estado' => $check
        ];


        BlogModel::where('id' , $id)->update($data_blog);
        $request->session()->flash('notificacion' , 'Registro actualizado');
        echo json_encode(['estado' => TRUE]);

    }


    public function configuracion()
    {

        $data['configuracion']  = ConfiguracionModel::first();
        return view('admin.configuracion' , $data);
    }


    public function cargarlogo(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }

        $logo   = ConfiguracionModel::first();
        echo json_encode(['estado' => TRUE , 'logo' => $logo]);
    }


    public function storeconfig(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }

        $id         = $request->input('id');
        $email      = $request->input('email');
        $telefono   = $request->input('telefono');
        $facebook   = $request->input('facebook');
        $twitter    = $request->input('twitter');
        $instagram  = $request->input('instagram');
        $logo       = $request->file('logo');


        /*
            Si el file llega vacío solo actualizamos los demas campos, en caso de haber file actualizamos la imagen
        */

        if(empty($logo))
        {
            $data_config =
            [
                'email'      => $email,
                'telefono'   => $telefono,
                'facebook'   => $facebook,
                'twitter'    => $twitter,
                'twitter'    => $facebook,
                'instagram'  => $instagram,
                'instagram'  => $instagram
            ];

            ConfiguracionModel::where('id' , $id)->update($data_config);
        }

        else 
        {
            $nombre_logo     = $logo->getClientOriginalName();
            $actual          = ConfiguracionModel::where('id' , $id)->first()['logo'];
            if($nombre_logo == $actual)
                {
                unlink(public_path('img/logo/' . $actual));
                $logo->move(public_path('img/logo/') , $nombre_logo);
            }
            else
                {
                $logo->move(public_path('img/logo/') , $nombre_logo);
            }

            $data_config =
            [
                'email'         => $email,
                'telefono'      => $telefono,
                'facebook'      => $facebook,
                'twitter'       => $twitter,
                'twitter'       => $facebook,
                'instagram'     => $instagram,
                'instagram'     => $instagram,
                'logo'          => $nombre_logo
            ];

            ConfiguracionModel::where('id' , $id)->update($data_config);
        }

        echo json_encode(['estado' => TRUE , 'mensaje' => 'Datos actualizados']);
    }

}
