<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoModel;
use App\Models\ImagenesModel;
use App\Models\ImagenReferenciaModel;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {
        if(!session('usuario')['login'])
        {
            return redirect()->to('/');
        }

        $data['productos']          = ProductoModel::select('productos.*', 'imagen_referencia.imagen as imagen')
                                            ->join('imagen_referencia' , 'imagen_referencia.idproducto' , '=' , 'productos.id')
                                            ->where('estado' , '1')
                                            ->get();
        return view('admin.productos' , $data);
    }


    public function obtener_productos()
    {

        $productos          = ProductoModel::select('productos.*', 'imagen_referencia.imagen as imagen')
                                            ->join('imagen_referencia' , 'imagen_referencia.idproducto' , '=' , 'productos.id')
                                            ->where('estado' , '1')
                                            ->get();

        return Datatables()
                             ->of($productos)
                             ->addIndexColumn(2)
                             ->addColumn('imagen', function($productos) {
                                $imagen  = $productos->imagen;
                                $btn     = '<img src="admin/uploads/productos/'.$imagen.'" style="width: 50px; height: 50px">';
                                return $btn;
                            })

                            ->addColumn('opciones', function($productos) {
                                $idproducto = $productos->id;
                                $btn        = '<a href="'. route("editarproducto" , $idproducto) .'" class="mr-1 text-warning" style="font-size: 18px" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a> 
                                    <a href="'. route("eliminarproducto" , $idproducto) .'" class="mr-1 text-danger btn_eliminar" style="font-size: 20px;" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash"></i></a>';
                                return $btn;
                              })
    
                            ->rawColumns(['imagen','opciones'])
                            ->make(true);
    }


    public function nuevoproducto()
    {
        if(!session('usuario')['login'])
        {
            return redirect()->to('/');
        }

        return view('admin.nuevoproducto');
    }

    public function agregar_producto(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }


        $nombre             = trim(strtoupper($request->input('nombre')));
        $descripcion        = $request->input('descripcion');
        $precio             = $request->input('precio');
        $stock              = $request->input('stock');
        $imagenes           = $request->file('imagenes');
        $primera_imagen     = $request->file('img_referencia');

        /*
            Algunas validaciones
        */
        if(strlen($nombre) < 4)
        {
            echo json_encode(['estado' => false, 'mensaje' => 'El nombre debe tener al menos 4 caracteres']);
            return; 
        }

        if(!is_numeric($precio))
        {
            echo json_encode(['estado' => false, 'mensaje' => 'El precio solo admite números']);
            return;
        }

        if(!is_numeric($stock))
        {
            echo json_encode(['estado' => false, 'mensaje' => 'El stock solo admite números']);
            return;
        }


        if(empty($imagenes))
        {
            echo json_encode(['estado' => false, 'mensaje' => 'Debe seleccionar una imagen']);
            return;
        }


        /*
            Agregamos el producto con la intención de obtener el id insertado
        */

        $data_producto      = 
        [
            'nombre'        => $nombre,
            'descripcion'   => $descripcion,
            'precio'        => $precio,
            'stock'         => $stock,
            'estado'        => 1
        ];    
        ProductoModel::insert($data_producto);
        $producto           = ProductoModel::latest('id')->first();

        /*
            Guardado de imagenes  
        */
        
        foreach($imagenes as $imagen)
        {
            $nombre = $imagen->getClientOriginalName();
            $imagen->move(public_path('admin/uploads/productos/') , $nombre);

            $data_imagen = 
            [
                'idproducto'    => $producto->id,
                'imagen'        => $nombre
            ];

            ImagenesModel::insert($data_imagen);
            
        }

        /*
            Guardaremos la imagen de referencia para mostrar en la lista principal de productos
        */
        $nombre_primera         = $primera_imagen->getClientOriginalName();
        $primera_imagen->move(public_path('admin/uploads/imagen_referencia/') , $nombre_primera);
        $data_imagen_referencia = 
        [
            'idproducto'     => $producto->id,
            'imagen'         => $nombre_primera 
        ];  
        ImagenReferenciaModel::insert($data_imagen_referencia);
        echo json_encode(['estado' => true]);
    }


    public function editarproducto($idproducto)
    {
        $data['producto']           =   ProductoModel::select('productos.*', 'imagen_referencia.imagen as imagen')
                                            ->join('imagen_referencia' , 'imagen_referencia.idproducto' , '=' , 'productos.id')
                                            ->where('productos.estado' , '1')
                                            ->where('productos.id' , $idproducto)
                                            ->first();
    
        return view('admin.editarproducto' , $data);
    }



    public function cargarimagenes(Request $request) 
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }

        $id             =   $request->input('id');
        $imagenes       =   ImagenesModel::where('idproducto' , $id)
                                            ->get();

        echo json_encode(['estado'     => TRUE , 'imagenes' => $imagenes]);
    }

    public function cargarimagenrefe(Request $request)
    {
       if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }
        
        $id             =   $request->input('id');
        $imagenrefere  = ImagenReferenciaModel::where('idproducto' , $id)
                                                            ->first();

        echo json_encode(['estado'     => TRUE , 'imagenrefere' => $imagenrefere]);
    }


    public function storeproducto(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['estado' => FALSE , 'mensaje' => 'Algo pasó, intente de nuevo']);
            return;
        }


        $id             = $request->input('id');
        $nombre         = trim(strtoupper($request->input('nombre')));
        $precio         = $request->input('precio');
        $stock          = $request->input('stock');
        $descripcion    = trim($request->input('descripcion'));
        $imagenes       = $request->file('imagenes');
        $img_referencia = $request->file('img_referencia');
        

        /*
            Si los inputs de las imagenes están vacias, solo actualizamos los demás campos, de lo contrario 
            reemplazamos las imagenes
        */

        if(empty($imagenes) && empty($img_referencia))
        {
            $data_producto  = 
            [
                'nombre'        => $nombre,
                'descripcion'   => $descripcion,
                'precio'        => $precio,
                'stock'         => $stock
            ];

            ProductoModel::where('id' , $id)->update($data_producto);
        }


        else 
        {
            if(!empty($imagenes))
            {
               $imagenes_db            = ImagenesModel::where('idproducto' , $id)->get();
                foreach($imagenes as $index => $imagen)
                {
                    if(!empty($imagen))
                    {
                        $data_imagen    =
                        [
                            'imagen'        => $imagen->getClientOriginalName()
                        ];

                        ImagenesModel::where('idproducto' , $id)
                                    ->where('id' , $imagenes_db[$index]->id)
                                    ->update($data_imagen);

                       unlink(public_path('admin/uploads/productos/' . $imagenes_db[$index]->imagen)); 
                       $imagen->move(public_path('admin/uploads/productos/') , $imagen->getClientOriginalName());
                    }
                } 
            }

            if(!empty($img_referencia))
            {
                // Actualizar imagen de referencia
                $referencia_db          = ImagenReferenciaModel::where('idproducto' , $id)->first();
                unlink(public_path('admin/uploads/imagen_referencia/' . $referencia_db->imagen));
                $img_referencia->move(public_path('admin/uploads/imagen_referencia/') , $img_referencia->getClientOriginalName());

                ImagenReferenciaModel::where('idproducto' , $id)->update(['imagen' => $img_referencia->getClientOriginalName()]);
            }
            
        }
    
        echo json_encode(['estado' => TRUE, 'mensaje' => 'Registro actualizado']);
    }


    public function eliminarproducto($idproducto , Request $request)
    {
        ProductoModel::where('id' , $idproducto)->update(['estado' => 0]);
        $request->session()->flash('notificacion' , 'Registro eliminado');
        return redirect()->to('productos');
    }

}
