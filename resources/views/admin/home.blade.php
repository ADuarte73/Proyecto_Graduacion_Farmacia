@extends('plantilla_admin')

    @section('title' , 'Admin')
    @section('content')
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Ingresos</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Q/{{ ($totales > 0) ? number_format($totales , 2, '.', ' ') : '0.00' }}</h1>
                        <small>Ingresos totales</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Órdenes</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $ordenes }}</h1>
                        <small>Órdenes totales</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Comentarios en el blog</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $comentarios }}</h1>
                        <small>Comentarios</small>
                    </div>
                </div>
            </div>
        </div>
    @endsection