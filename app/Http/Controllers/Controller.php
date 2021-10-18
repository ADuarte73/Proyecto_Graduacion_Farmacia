<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\ProductoModel;
use App\Models\ImagenesModel;
use App\Models\ImagenReferenciaModel;
use App\Models\ConfiguracionModel;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function crear_carrito()
    {
        /*
            Comparamos si no existe sesión o si existen productos en el carrito, 
            creamos el contenido de la variable y seteamos la sesion.
            De lo contrario calculamos los totales.
        */

        if(!session()->get('cart') || empty(session()->get('cart')['productos']))
        {
            $cart = 
            [
                'cart' =>
                [
                    'productos'     => [],
                    'subtotal'      => 0,
                    'total'         => 0,
                    'envio'         => 0
                ]
            ];

            session($cart);
            return session()->get('cart');
        }

       
        $subtotal   = 0;
        $total      = 0;
        $envio      = 0;

        foreach(session('cart')['productos'] as $index => $producto)
        {
            $_subtotal = ((int) $producto['precio'] * (int) $producto['cantidad']);
            $subtotal  = $subtotal + $_subtotal;
            session()->put('cart.productos.' . $index , $producto);
        }

        $total      = $subtotal + $envio;

        $cart = 
            [
                'cart' =>
                [
                    'productos'     => session('cart')['productos'],
                    'subtotal'      => $subtotal,
                    'total'         => $total,
                    'envio'         => $envio
                ]
            ];


        session($cart);
        return session()->get('cart');

    }


    /*
        Agregar un producto al carrito
    */
    public function agregar_productocarrito($idproduct , $cantidad)
    {
        $producto        = ProductoModel::select('productos.*' , 'img.imagen as imagen')
                                    ->join('imagen_referencia as img' , 'img.idproducto', '=' , 'productos.id')
                                    ->where('productos.estado' , 1)
                                    ->where('productos.id' , $idproduct)
                                    ->first();


        if(!$producto)
        {
            return false;
        }

        $new_product    =
        [
            'id'            => $producto->id,
            'nombre'        => $producto->nombre,
            'descripcion'   => $producto->descripcion,
            'cantidad'      => $cantidad,
            'precio'        => $producto->precio,
            'stock'         => $producto->stock,
            'imagen'        => $producto->imagen
        ];

        /*
            Si los productos del carrito están vacíos entonces lo agregamos
        */

        if( empty(session()->get('cart')['productos']) )
        {
            session()->push('cart.productos' , $new_product);
            return true;
        }

        /*
            Si no, al menos ya hay uno, entonces lo recorremos
        */
        foreach(session()->get('cart')['productos'] as $index => $product)
        {
            /*
                Si el id del producto ingresado coincide con el id del producto del bucle, sumamos la cantidad,
                de lo contrario, asimilamos que es un producto nuevo y agregamos
            */
            if($idproduct == $product['id']) {
                $product['cantidad'] = $product['cantidad'] + $cantidad;
                session()->put('cart.productos.' . $index , $product);
                return true;
            }

        }

        session()->push('cart.productos' , $new_product);
        return true;

    }



    /*
        Remover un producto del carrito
    */
    public function eliminar_productocarrito($idproduct)
    {

        /*
            Validamos si existen productos en el carrito, si en caso hay, empezamos a recorrer entre los productos
        */
        if( empty(session()->get('cart')['productos']))
        {
            return false;
        }


        foreach( session()->get('cart')['productos'] as $index => $product)
        {
            /*
                Si el id del producto entrante coincide con el id del producto del ciclo
                eliminamos el registro
            */

            if($idproduct == $product['id'])
            {
                session()->forget('cart.productos.' . $index , $product);
                return true;
            }

        }
        return false;
    }


    /*
        Actualizar la cantidad de un producto
    */
    public function actualizar_cantidad($idproduct , $cantidad)
    {
        if(empty(session()->get('cart')['productos']))
        {
            return false;
        }

        foreach(session()->get('cart')['productos'] as $index => $product)
        {
            if($idproduct == $product['id'])
            {
                $product['cantidad']    =  $cantidad;
                session()->put('cart.productos.' . $index , $product);
                return true;
            }
        }
    }


    /*
        Eliminar el carrito de compras
    */
    public function destruir_carrito()
    {
        if(!session()->get('cart') || empty( session()->get('cart')['productos']) )
        {
            return false;
        }

        session()->forget('cart');
        return true;
    }


    /*
        Obtener la cantidad de productos existentes
    */
    public function obtener_cantidadproductos()
    {
        $cantidad = 0;
        if(!session()->get('cart') || empty( session()->get('cart')['productos']) )
        {
            $cantidad = 0;
            return $cantidad;
        }

        foreach( session()->get('cart')['productos'] as $index => $product)
        {
            $cantidad = $cantidad + $product['cantidad'];
        }

        return $cantidad;
    }


    public function configinfo()
    {
        $config = ConfiguracionModel::first();
        return $config;
    }

}
