@extends('plantilla_admin')

    @section('title' , 'Actualizar información')
    @section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Actualizar información</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Configuración</a>
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
                            <h5>Actualizar información</h5>
                        </div>

                        <div class="ibox-content">
                            <form id="form_editarconfig" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="logo" class="col-form-label">Logo:</label>
                                            <input type="hidden" name="id" value="{{ $configuracion->id }}">
                                            <input type="file" id="logo" class="form-control form-control-sm" name="logo">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">Email:</label>
                                            <input type="text" id="email" class="form-control" name="email" value="{{ $configuracion->email }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono" class="col-form-label">Teléfono:</label>
                                            <input type="text" id="telefono" class="form-control" name="telefono" value="{{ $configuracion->telefono }}"> 
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="facebook" class="col-form-label">Facebook:</label>
                                            <input type="text" id="facebook" class="form-control text-uppercase" name="facebook" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="twitter" class="col-form-label">Twitter:</label>
                                            <input type="text" id="twitter" class="form-control text-uppercase" name="twitter" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="instagram" class="col-form-label">Instagram:</label>
                                            <input type="text" id="instagram" class="form-control text-uppercase" name="instagram" value=""> 
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="facebook" class="col-form-label d-block">Logo actual:</label>
                                            <div id="wrapper_logo"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block btn_editarconfig">Guardar</button>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <a href="{{ route('admin') }}" class="btn btn-danger btn-block">Volver</a>
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
            function cargar_logo()
            {
                let html    = '';

                $.ajax({
                    url         : "{{ route('cargarlogo') }}",
                    method      : 'POST',
                    data        : {
                        '_token' : "{{ csrf_token() }}"
                    },
                    success     : function(r) {
                        if(!r.estado) 
                        {
                            $('body').waitMe('hide');
                            message_toast('warning' , r.mensaje);
                            return;
                        }   

                        html += `<img src="{{ asset('img/logo/') }}/${r.logo.logo}" alt="" width="50%">`;
                        $('#wrapper_logo').html(html);
                    },
                    dataType    : 'json' 
                });        
            }

            cargar_logo();


            $('body').on('click' , '.btn_editarconfig' , function(e) {
                e.preventDefault();
                let form = new FormData($('#form_editarconfig')[0]);
                    $.ajax({
                        url         : "{{ route('storeconfig') }}",
                        method      : 'POST',
                        cache       : false,
                        contentType : false,
                        processData : false,
                        data        : form,
                        success     : function(r){
                            if(!r.estado) 
                            {
                                message_toast('warning' , r.mensaje);
                                return;
                            }

                            cargar_logo();
                            message_toast('success' , r.mensaje);
                        },
                        dataType    : 'json'
                    });
            });
        </script>
    @endsection