@extends('plantilla_admin')

    @section('title' , 'Ordenes')
    @section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Órdenes</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Órdenes</a>
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
                            <h5>Lista de órdenes</h5>
                        </div>

                        <div class="ibox-content">
                        @if(!$ordenes->isEmpty())
                            <div class="table-responsive">
                                <table id="tabla_ordenes" class="table table-hover table-striped">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Órden</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        @else
                                <div class="text-center">
                                    <img src="{{ asset('img/404_art.jpg') }}" alt="" width="55%">
                                    <p class="text-danger font-weight-bold">*Actualmente no hay órdenes</p>
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
            function cargar_tabla()
            {
                $('#tabla_ordenes').DataTable({
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
                    "ajax"       : "{{ url('obtener_ordenes') }}",
                    "columns"    : [
                        { data : 'cliente' , className : 'text-center'},
                        { data : 'email' , className : 'text-center align-middle'},
                        { data : 'telefono' , className : 'text-center align-middle'},
                        { data : 'direccion' , className : 'text-center align-middle'},
                        { data : 'orden' , render : function(data){
                            return `<a href="admin/uploads/ordenes/${data}" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>`;
                        },className : 'text-center align-middle'},
                        
                        { data : 'opciones' , className : 'text-center align-middle'}
                    ]
                });
            }

            cargar_tabla();

            $('#tabla_ordenes_paginate').addClass('float-right').addClass('mr-2');
        </script>
    @endsection