@extends('plantilla')   
    
    @section('title' , 'Tracking')
    @section('content')  
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Tracking</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Tracking</li>
                </ul>
            </div>
        </div>


        <div class="container padding-bottom-3x mb-1">
            <div class="card mb-3">
          <div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-uppercase">Orden de tracking N° - </span><span class="text-medium">{{ $orden->tracking }}</span></div>
          <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Estado:</span> {{ $orden->estado }}</div>
          </div>
          <div class="card-body">
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
              <div class="step {{ ($orden->estado == 'CONFIRMADO' ||  
                                    $orden->estado == 'PROCESANDO' ||  
                                    $orden->estado == 'CONTROL DE CALIDAD' ||  
                                    $orden->estado == 'DESPACHADO' ||  
                                    $orden->estado == 'RECIBIDO') ? 'completed' : '' }}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-cart"></i></div>
                </div>
                <h4 class="step-title">Orden confirmada</h4>
              </div>

              <div class="step {{ ($orden->estado == 'PROCESANDO' ||  
                                    $orden->estado == 'CONTROL DE CALIDAD' ||  
                                    $orden->estado == 'DESPACHADO' ||  
                                    $orden->estado == 'RECIBIDO')  ? 'completed' : ''}}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-config"></i></div>
                </div>
                <h4 class="step-title">Procesando orden</h4>
              </div>

              <div class="step {{ ($orden->estado == 'CONTROL DE CALIDAD' ||  
                                    $orden->estado == 'DESPACHADO' ||  
                                    $orden->estado == 'RECIBIDO')  ? 'completed' : ''}}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-medal"></i></div>
                </div>
                <h4 class="step-title">Control de calidad</h4>
              </div>

              <div class="step {{ ($orden->estado == 'DESPACHADO' ||  
                                    $orden->estado == 'RECIBIDO')  ? 'completed' : ''}}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-car"></i></div>
                </div>
                <h4 class="step-title">Despacho</h4>
              </div>

              <div class="step {{ ($orden->estado == 'RECIBIDO')  ? 'completed' : ''}}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-home"></i></div>
                </div>
                <h4 class="step-title">Recibido</h4>
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
    @endsection

    @section('scripts')
      
    @endsection