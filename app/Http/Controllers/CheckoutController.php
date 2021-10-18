<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\OrdenesModel;
use App\Models\DetalleOrdenModel;
use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $data['configinfo']  = $this->configinfo();
        return view('checkout' , $data);
    }


    public function total_checkout(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }   

        $carrito = $this->crear_carrito();
        $html    = '';

        if(empty($carrito['productos']))
        {
            $html .= '<div class="text-center"><p>Carrito vacio</p></div>';
        }

        else 
        {
            $html .= '<h3 class="widget-title">Resumen de orden</h3>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Subtotal:</td>
                                <td class="text-medium">Q/'.number_format($carrito["subtotal"], 2, ".", " ").'</td>
                            </tr>
                          <tr>
                            <td>Envío:</td>
                            <td class="text-medium">Q/'.number_format($carrito["envio"], 2, ".", " ").'</td>
                          </tr>

                          <tr>
                            <td></td>
                            <td class="text-lg text-medium">Q/'.number_format($carrito["total"], 2, ".", " ").'</td>
                          </tr>
                        
                        </tbody>
                        </table>';
        }

        echo json_encode(['estado' => TRUE, 'orden_sumario' => $html]);
    }


    public function direccion_envio(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }

        $nombres            = ucwords($request->input('nombres'));
        $apellidos          = ucwords($request->input('apellidos'));
        $email              = $request->input('email');
        $telefono           = $request->input('telefono');
        $direccion          = $request->input('direccion');
        $referencia         = $request->input('referencia');

        $direccion_envio    = 
        [
            'nombres'       => $nombres,
            'apellidos'     => $apellidos,
            'email'         => $email,
            'telefono'      => $telefono,
            'direccion'     => $direccion,
            'referencia'    => $referencia
        ];

        $request->session()->put('direccion_envio' , $direccion_envio);
        echo json_encode(['estado' => TRUE]);
    }

    public function pagar()
    {
        $data['configinfo']  = $this->configinfo();
        return view('pagar' , $data);
    }

    public function pago(Request $request)
    {
        $payment_id     = $request->get('payment_id');
        $response       = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=TEST-6753934747657615-090916-593f2919f131ee60b89764ea24e76ac3-821634411");

        $response       = json_decode($response);
        $status         = $response->status;
        $caracteres     = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0 , 2);
        $permitidos     = substr(str_shuffle('0123456789'), 0 , 4);
        $tracking       = $caracteres . $permitidos;


        if($status = 'approved')
        {
            session(['tracking' => $tracking]);
            $orden      = $this->generar_orden();
            $dataorden  =
            [
                'payment_id' => $payment_id,
                'cliente'    => session('direccion_envio')['nombres'] . ' ' . session('direccion_envio')['apellidos'],
                'email'      => session('direccion_envio')['email'],
                'telefono'   => session('direccion_envio')['telefono'],
                'direccion'  => session('direccion_envio')['direccion'],
                'referencia' => session('direccion_envio')['referencia'],
                'total'      => number_format(session('cart')['total'], 2, '.' , ' '),
                'orden'      => $orden,
                'tracking'   => $tracking,
                'estado'     => 1
            ];

            OrdenesModel::insert($dataorden);
            $idorden     = OrdenesModel::latest('id')->first()->id;

            foreach(session('cart')['productos'] as $index => $producto)
            {
                $datadetalle =
                [
                    'idorden'   => $idorden,
                    'producto'  => $producto['nombre'],
                    'cantidad'  => $producto['cantidad'],
                    'subtotal'  => number_format(($producto['precio'] * $producto['cantidad']) , 2 , '.', ' ')
                ];

                DetalleOrdenModel::insert($datadetalle);
            }

            /*
                Enviamos por correo el numero de tracking
            */
            $correo         = new ContactoMailable;
            Mail::to(session('direccion_envio')['email'])->send($correo);


            /*
                Destruimos el carrito
            */
            $this->destruir_carrito();
            return $this->orden($tracking);
        }

        return 'Por si pasa algo imprevisto...';
    }


    public function orden($tracking)
    {
        $data['tracking'] = $tracking;
        $data['configinfo']  = $this->configinfo();
        
        return view('orden' , $data);
    }


    public function generar_orden()
    {
        $data['carrito'] = $this->crear_carrito();
        $pdf    = PDF::loadView('resumen', $data)->setPaper('b7', 'portrait');
        $nombre = date('Y-m-d-H-i-s') . '.pdf'; 
        $pdf->save('admin/uploads/ordenes/' . $nombre);
        return $nombre;

        /*
            stream() para mostrar en el navegador
            save() para guardar en una carpeta especifica
            download() para descargar directamente
        */
    }

}
