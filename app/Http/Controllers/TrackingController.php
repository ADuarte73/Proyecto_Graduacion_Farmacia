<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenesModel;
use App\Models\EstadosModel;

class TrackingController extends Controller
{

    public function index()
    {
        $data['configinfo']  = $this->configinfo();
        return view('consulta', $data);
    }

    public function tracking(Request $request)
    {

        $tracking           = strtoupper($request->input('tracking'));
        $data['orden']      = OrdenesModel::where('tracking' , $tracking)
                                    ->join('estados' , 'estados.id' , '=' , 'ordenes.estado')
                                    ->first();
                                    
        if(!$data['orden'])
        {
            $data['configinfo']  = $this->configinfo();
            return view('error' , $data);
        }

        $data['estados']    = EstadosModel::get();
        $data['configinfo'] = $this->configinfo();

        return view('tracking' , $data);
    }
}
