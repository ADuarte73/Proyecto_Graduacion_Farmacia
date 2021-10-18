@extends('plantilla_admin')

    @section('title' , 'Nuevo producto')
    @section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Nuevo producto</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.productos') }}">Productos</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Nuevo producto</a>
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
                            <h5>Nuevo producto</h5>
                        </div>

                        <div class="ibox-content">
                            <form id="form_nuevoproducto" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre" class="col-form-label">Nombre:</label>
                                            <input type="text" id="nombre" class="form-control text-uppercase" name="nombre">
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
                                                <input type="text" id="precio" class="form-control" name="precio">
                                                <div class="input-group-append">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                                <span class="invalid-feedback">El campo no debe quedar vacío</span>
                                            </div>
                                            <span class="invalid-feedback">El campo no debe quedar vacío</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock" class="col-form-label">Stock:</label>
                                            <input type="text" id="stock" class="form-control" name="stock">
                                            <span class="invalid-feedback">El campo no debe quedar vacío</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion" class="col-form-label">Descripción:</label>
                                            <textarea id="descripcion" class="form-control" cols="10" rows="8" name="descripcion"></textarea>
                                            <span class="invalid-feedback">El campo no debe quedar vacío</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="imagenes" class="col-form-label">Imágenes: 
                                                <i class="fa fa-plus-circle text-success icon_plus" style="cursor: pointer;" data-toggle="tooltip" title="Agregar más imágenes"></i> 
                                            </label>
                                            <input type="file" class="form-control" multiple name="imagenes">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block btn_agregarproducto">Guardar</button>
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
            // Agregamos un nuevo input de tipo file para las imágenes
            $('body').on('click' , '.icon_plus' , function(e) {
                e.preventDefault();
                $(this).parent().parent().append('<input type="file" class="form-control" multiple name="imagenes">');
            });


            // Acción para agregar un nuevo producto
            $('body').on('click' , '.btn_agregarproducto' , function(e) {
                e.preventDefault();
                let form        = new FormData($('#form_nuevoproducto')[0]),
                    nombre      = $('input[name="nombre"]').val(),
                    precio      = $('input[name="precio"]').val(),
                    stock       = $('input[name="stock"]').val(),
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
                    
                    $.each($('input[type="file"]') , function(index, imagen) {
                        form.append('imagenes[]' , imagen.files[0]);
                    });

              
                    form.append('nombre'        , nombre);
                    form.append('descripcion'   , descripcion);
                    form.append('precio'        , precio);
                    form.append('stock'         , stock);
                    form.append('img_referencia', $('input[type="file"]')[0].files[0]);


                    $.ajax({
                            url         : "{{ route('agregar_producto') }}",
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
                                $('#form_nuevoproducto').trigger('reset');
                                message_toast('success' , 'Agregado correctamente');
                            },
                            dataType    : 'json' 
                    });
                }

            });
            
        </script>
    @endsection