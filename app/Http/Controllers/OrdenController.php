<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenesModel;
use App\Models\DetalleOrdenModel;
use App\Models\EstadosModel;

class OrdenController extends Controller
{
    public function index()
    {
        $data['ordenes'] = OrdenesModel::orderBy('id' , 'DESC')->get();
        return view('admin.ordenes' , $data);
    }


    public function obtener_ordenes()
    {
        $ordenes          = OrdenesModel::orderBy('id' , 'DESC')->get();

        return Datatables()
                            ->of($ordenes)
                            ->addIndexColumn(1)
                            ->addColumn('opciones', function($ordenes) {
                                $idorden = $ordenes->id;
                                $btn        = '<a href="'. route("actualizarorden" , $idorden) .'" class="mr-1 text-primary" style="font-size: 18px" data-toggle="tooltip" title="Actualizar"><i class="fa fa-cog"></i></a>';
                                return $btn;
                              })
    
                            ->rawColumns(['opciones'])
                            ->make(true);
    }



    public function actualizarorden($orden)
    {
        $data['orden']      = OrdenesModel::where('id' , $orden)->first();
        $data['estados']    = EstadosModel::get();


        return view('admin.actualizarorden' , $data);
    }


    public function store_orden(Request $request)
    {
        $idorden = $request->input('orden');
        $estado  = $request->input('estado');

        OrdenesModel::where('id' , $idorden)
                    ->update(['estado' => $estado]);

        $request->session()->flash('notificacion' , 'Estado actualizado');
        return redirect('actualizarorden/' . $idorden);
    }

}
