<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
      if(session('usuario') && session('usuario')['login'])
        {
            return redirect()->to('/home');
        }
        
        $data['configinfo']  = $this->configinfo();
        return view('carrito' , $data);
    }


    public function cargar_carrito(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intentde de nuevo']);
            return;
        }


        $carrito = $this->crear_carrito();
        $html    = '';

        if(empty($carrito['productos']))
        {
            $html .= '<div class="text-center"><img src="'. url("img/opencart.png") .'"><p class="text-danger font-weight-bold mt-3 mr-5">El carrito está vacío</p></div>';
        }   

        else
        {
            $html .= '<div class="table-responsive shopping-cart">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nombre producto</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center"><a class="btn btn-sm btn-outline-danger btn_limpiarcarrito" href="#">Limpiar carrito</a></th>
                  </tr>
                </thead>
                <tbody>';
                foreach($carrito['productos'] as $index => $producto):
                $html .= '<tr>
                    <td>
                      <div class="product-item">
                        <a class="product-thumb" href="shop-single.html">
                            <img src="'. url("admin/uploads/imagen_referencia/" . $producto["imagen"]) .'" alt="Product">
                        </a>
                        <div class="product-info align-middle">
                          <h4 class="product-title"><a href="'.url("detalle/" . $producto["id"]).'">'. $producto["nombre"] .'</a></h4>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <div class="count-input">
                        <input type="text" value="'. $producto['cantidad'] .'" class="form-control">
                      </div>
                    </td>
                    <td class="text-center text-lg text-medium">Q/'. number_format(($producto["precio"] * $producto["cantidad"]), 2, ".", " ") .'</td>
                    <td class="text-center"><a class="remove-from-cart btn_removerproducto" data-id="'.$producto["id"].'" href="#" data-toggle="tooltip" title="" data-original-title="Quitar producto"><i class="icon-cross"></i></a></td>
                  </tr>';
                endforeach;
                $html .= '</tbody>
              </table>
            </div>
            <div class="shopping-cart-footer">
              <div class="column text-lg">Subtotal: <span class="text-medium">Q/'. number_format($carrito["subtotal"], 2, ".", " ") .'</span></div>
            </div>
            <div class="shopping-cart-footer">
              <div class="column text-lg">Envío: <span class="text-medium">Q/'. number_format($carrito["envio"], 2, ".", " ") .'</span></div>
            </div>
            <div class="shopping-cart-footer">
              <div class="column text-lg" style="font-size: 20px">Total: <span class="text-medium">Q/'. number_format($carrito["total"], 2, ".", " ") .'</span></div>
            </div>
            <div class="shopping-cart-footer">
              <div class="column">
                  <a class="btn btn-outline-secondary" href="'. url("catalogo") .'"><i class="icon-arrow-left"></i>&nbsp;Seguir comprando</a>
              </div>
              <div class="column"><a class="btn btn-primary" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart" data-toast-message="is updated successfully!">Actualizar</a><a class="btn btn-success" href="'.url("checkout").'">Checkout</a></div>
            </div>';
        }

        echo json_encode(['estado' => TRUE, 'carrito' => $html]);
    }   



    public function eliminar_producto(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intentde de nuevo']);
            return;
        }

        $id         = $request->input('id');
        $eliminado  = $this->eliminar_productocarrito((int) $id);
        if(!$eliminado)
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'No se pudo quitar el producto']);
            return;
        }

        echo json_encode(['estado' => TRUE, 'mensaje' => 'Producto quitado del carrito']);
    }


    public function cantidad_productos(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intentde de nuevo']);
            return;
        }

        $cantidad = $this->obtener_cantidadproductos();
        echo json_encode(['estado' => TRUE , 'cantidad' => $cantidad]);
    }


    public function total_carrito(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intentde de nuevo']);
            return;
        } 

        $carrito = $this->crear_carrito();
        $total   = number_format($carrito['total'], 2, '.', ' ');
        echo json_encode(['estado' => TRUE , 'total' => $total]);
    }


    public function toolbarcarrito(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intentde de nuevo']);
            return;
        } 

        $carrito = $this->crear_carrito();
        $html    = '';

        if(empty($carrito['productos']))
        {
            $html .= '<div class="text-center"><img width="50px" src="'. url("img/opencart.png") .'"><p class="text-danger font-weight-bold mt-2">Carrito vacío</p></div>';
        }

        else
        {
            foreach($carrito['productos'] as $index => $producto):
            $html .= '<div class="dropdown-product-item">
                        <span class="dropdown-product-remove btn_removerproducto" data-id="'.$producto["id"].'"><i class="icon-cross"></i></span>
                        <a class="dropdown-product-thumb" href="'.url("detalle/" . $producto["id"]).'"><img src="'. url("admin/uploads/imagen_referencia/" . $producto["imagen"]) .'" alt="Product"></a>
                        <div class="dropdown-product-info">
                            <a class="dropdown-product-title" href="'.url("detalle/" . $producto["id"]).'">'.$producto["nombre"].'</a>
                            <span class="dropdown-product-details">'.$producto["cantidad"].' x Q/'.number_format($producto["precio"], 2 , ".", " ").'</span>
                        </div>
                    </div>';
            endforeach;

            $html .= '<div class="toolbar-dropdown-group">
                  <div class="column"><span class="text-lg">Total(+envío):</span></div>
                  <div class="column text-right"><span class="text-lg text-medium">Q/'.$carrito["total"].'&nbsp;</span></div>
                </div>

                <div class="toolbar-dropdown-group">
                  <div class="column"><a class="btn btn-sm btn-block btn-secondary" href="'.url("carrito").'">Carrito</a></div>
                  <div class="column"><a class="btn btn-sm btn-block btn-success" href="'.url("checkout").'">Checkout</a></div>
                </div>';
        }

        echo json_encode(['estado' => TRUE, 'carrito' => $html]);
    }



    public function removercarrito(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'Algo pasó, intentde de nuevo']);
            return;
        } 


        $remover  = $this->destruir_carrito();
        if(!$remover)
        {
            echo json_encode(['estado' => FALSE, 'mensaje' => 'No se pudo vaciar el carrito']);
            return;
        }

        echo json_encode(['estado' => TRUE, 'mensaje' => 'Carrito vacío']);
    }


}
