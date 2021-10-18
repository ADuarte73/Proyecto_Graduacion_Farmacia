@extends('plantilla_admin')

    @section('title' , 'Editar producto')
    @section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Editar producto</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.productos') }}">Productos</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Editar producto</a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Editar producto</h5>
                        </div>

                        <div class="ibox-content">
                            <form id="form_editarproducto" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre" class="col-form-label">Nombre:</label>
                                            <input type="hidden" class="form-control" name="id" value="{{ $producto->id }}">
                                            <input type="text" id="nombre" class="form-control text-uppercase" name="nombre" value="{{ $producto->nombre }}"> 
                                            <span class="invalid-feedback">El campo no debe quedar vacío</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precio" class="col-form-label">Precio:</label>
                                            <div class="input-group m-b">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-addon">Q/</span>
                                                </div>
                                                <input type="text" id="precio" class="form-control" name="precio" value="{{ $producto->precio }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback">El campo no debe quedar vacío</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock" class="col-form-label">Stock:</label>
                                            <input type="text" id="stock" class="form-control" name="stock" value="{{ $producto->stock }}">
                                            <span class="invalid-feedback">El campo no debe quedar vacío</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion" class="col-form-label">Descripción:</label>
                                            <textarea id="descripcion" class="form-control" cols="10" rows="8" name="descripcion">{{ $producto->descripcion }}</textarea>
                                            <span class="invalid-feedback">El campo no debe quedar vacío</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="imagenes" class="col-form-label">Imágenes:</label>
                                            <div id="wrapper_cargarimagenes" class=""></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="imagenes" class="col-form-label">Imagen de referencia:</label>
                                            <div id="wrapper_imgreferencia" class=""></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block btn_editarproducto">Guardar</button>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <a href="{{ route('admin.productos') }}" class="btn btn-danger btn-block">Volver</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            // Acción para editar un producto
            $('body').on('click' , '.btn_editarproducto' , function(e) {
                e.preventDefault();
                let form        = new FormData($('#form_editarproducto')[0]),
                    nombre      = $('input[name="nombre"]').val(),
                    precio      = $('input[name="precio"]').val(),
                    stock       = $('input[name="stock"]').val(),
                    id          = $('input[name="id"]').val(),
                    descripcion = $('textarea[name="descripcion"]').val();

                if(nombre == '')
                {
                    $('input[name="nombre"]').addClass('is-invalid');
                }
                else {
                    $('input[name="nombre"]').removeClass('is-invalid');
                }

                if(precio == '')
                {
                    $('input[name="precio"]').addClass('is-invalid');
                }
                else {
                    $('input[name="precio"]').removeClass('is-invalid');
                }

                if(stock == '')
                {
                    $('input[name="stock"]').addClass('is-invalid');
                }
                else {
                    $('input[name="stock"]').removeClass('is-invalid');
                }

                if(descripcion == '')
                {
                    $('textarea[name="descripcion"]').addClass('is-invalid');
                }
                else {
                    $('textarea[name="descripcion"]').removeClass('is-invalid');
                }


                if(nombre != '' && descripcion != '' && precio != '' && stock != '') {
                    
                    $.ajax({
                            url         : "{{ route('storeproducto') }}",
                            method      : 'POST',
                            data        : form,
                            cache       : false,
                            processData : false,
                            contentType : false,
                            beforeSend  : function(){
                                $('body').waitMe({
                                    effect   : 'rotateplane'
                                });
                            },
                            success     : function(r) {
                                if(!r.estado) 
                                {
                                    $('body').waitMe('hide');
                                    message_toast('warning' , r.mensaje);
                                    return;
                                }   

                                $('body').waitMe('hide');
                                cargar_imagenes();
                                cargar_imagenreferencia()
                                message_toast('success' , r.mensaje);
                            },
                            dataType    : 'json' 
                    });
                }
            });

            /*
                Crearemos dos funciones para cargar las imagenes de manera dinámica
            */

            function cargar_imagenes()
            {
                let id      = $('input[name="id"]').val(),
                    html    = '';

                $.ajax({
                    url         : "{{ route('cargarimagenes') }}",
                    method      : 'POST',
                    data        : {
                        '_token' : "{{ csrf_token() }}",
                        id       : id
                    },
                    success     : function(r) {
                        if(!r.estado) 
                        {
                            $('body').waitMe('hide');
                            message_toast('warning' , r.mensaje);
                            return;
                        }   

                        $.each(r.imagenes , function(index, imagen) {
                            html += `<img src="{{ asset('admin/uploads/productos/') }}/${imagen.imagen}" alt="" class="img-fluid rounded-circle d-block mx-auto my-2" width="80px" height="80px"><input type="file" class="form-control" multiple name="imagenes[]">`;
                        });

                        $('#wrapper_cargarimagenes').html(html);
                    },
                    dataType    : 'json' 
                });        
            }

            cargar_imagenes();

            function cargar_imagenreferencia()
            {
                let id      = $('input[name="id"]').val(),
                    html    = '';

                $.ajax({
                    url         : "{{ route('cargarimagenrefe') }}",
                    method      : 'POST',
                    data        : {
                        '_token' : "{{ csrf_token() }}",
                        id       : id
                    },
                    success     : function(r) {
                        if(!r.estado) 
                        {
                            $('body').waitMe('hide');
                            message_toast('warning' , r.mensaje);
                            return;
                        }   

                        html += `<img src="{{ asset('admin/uploads/imagen_referencia/') }}/${r.imagenrefere.imagen}" alt="" class="img-fluid rounded-circle d-block mx-auto my-2" width="80px" height="80px">
                                                <input type="file" class="form-control" multiple name="img_referencia">`;

                        $('#wrapper_imgreferencia').html(html);
                    },
                    dataType    : 'json' 
                });        
            }

            cargar_imagenreferencia();
        </script>
    @endsection