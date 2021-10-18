@extends('plantilla_admin')

    @section('title' , 'Productos')
    @section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Productos</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Productos</a>
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
                            <h5>Lista de productos</h5>
                            <a href="{{ route('nuevoproducto') }}" class="btn btn-primary ml-3" style="margin-top: -8px;">Agregar</a>
                        </div>

                        <div class="ibox-content">
                            @if(!$productos->isEmpty())
                            <div class="table-responsive">
                                <table id="tabla_productos" class="table table-hover table-striped">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th width="13%">Opciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            @else
                                <div class="text-center">
                                    <img src="{{ asset('img/404_art.jpg') }}" alt="" width="55%">
                                    <p class="text-danger font-weight-bold">*Actualmente no hay productos</p>
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
                $('#tabla_productos').DataTable({
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
                    "ajax"       : "{{ url('obtener_productos') }}",
                    "columns"    : [
                        { data : 'imagen' , className : 'text-center'},
                        { data : 'nombre' , className : 'text-center align-middle'},
                        { data : 'precio' , render    : function(data) {
                            return 'Q/'+parseFloat(data).toFixed(2);
                        }, className : 'text-center align-middle'},
                        { data : 'stock' , className : 'text-center align-middle'},
                        { data : 'opciones' , className : 'text-center align-middle'}
                    ]
                });
            }

            cargar_tabla();

            $('#tabla_productos_paginate').addClass('float-right').addClass('mr-2');
        </script>
    @endsection 