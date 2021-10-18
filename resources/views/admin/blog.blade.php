@extends('plantilla_admin')

    @section('title' , 'Blog')
    @section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Blog</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Blog</a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div id="wrapper_tabla" class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Lista de comentarios</h5>
                        </div>

                        <div class="ibox-content">
                            @if(!$comentarios->isEmpty())
                            <div class="table-responsive">
                                <table id="table_comentarios" class="table table-hover table-striped">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th width="40%">Comentario</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th width="10%">Opción</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            @else
                                <div class="text-center">
                                    <img src="{{ asset('img/404_art.jpg') }}" alt="" width="55%">
                                    <p class="text-danger font-weight-bold">*Actualmente no hay comentarios</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            let notificacion = "{{ session('notificacion') }}";
            if(notificacion)
            {
                message_toast('success' , notificacion);
            }
            // Mostrar los datos en la table utilizando DataTables
            function cargar_tabla()
            {
                $('#table_comentarios').DataTable({
                    pageLength: 4,
                    "serverSide" : true,
                    "processing" :true, 
                    responsive: true,
                    "ordering": false,
                    "lengthMenu": [
                        [4, 15, 30, -1],
                        [4, 15, 30, 200]
                    ],
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        "infoEmpty": "Sin resultados encontrados",
                        "infoFiltered": "(Filtrado de _MAX_ entradas en total)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                    "ajax"       : "{{ url('obtener_comentarios') }}",
                    "columns"    : [
                        { data : 'nombre' , className : 'text-center align-middle'},
                        { data : 'email' , className : 'text-center align-middle'},
                        { data : 'comentario' , className : 'text-justify'},
                        { data : 'fecha' , render:  function(data) {
                            return moment(data).format('DD-MM-YYYY');
                        } ,className : 'text-center align-middle'},
                        { data : 'estado' , className : 'text-center align-middle'},
                        { data : 'opciones' , className : 'text-center align-middle'}
                    ]
                });
            }

            cargar_tabla();


            /*
                Cambiar estado de cada comentario y decidir si mostrar o no
            */

            $('body').on('click' , '.btn_cambiarestado', function (e){
                e.preventDefault();
                let id      = $(this).data('id'),
                    check   = $(this).data('check');


                    $.ajax({
                        url         : "{{ route('actualizar_check') }}",
                        method      : 'POST',
                        data        : {
                            '_token' : "{{ csrf_token() }}",
                            id       : id,
                            check    : check
                        },
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
                            window.location.href = "{{ route('admin.comentarios') }}";
                        },
                        dataType    : 'json' 
                    });    
            });


            $('#table_comentarios_paginate').addClass('float-right').addClass('mr-2');
        </script>
    @endsection 