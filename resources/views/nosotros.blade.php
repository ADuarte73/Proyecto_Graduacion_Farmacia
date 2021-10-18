@extends('plantilla')   
    
    @section('title' , 'Sobre nosotros')
    @section('content')  
        <div class="page-title">
            <div class="container">
                <div class="column">
                    <h1>Sobre nosotros</h1>
                </div>
                <div class="column">
                    <ul class="breadcrumbs">
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="separator">&nbsp;</li>
                        <li>
                            <a href="">Nosotros</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container padding-bottom-2x mb-2">
            <div class="row align-items-center padding-bottom-2x">
                <div class="col-md-5"><img class="d-block w-270 m-auto" src="{{ asset('img/features/01.jpg') }}" alt="Online Shopping"></div>
                <div class="col-md-7 text-md-left text-center">
                    <div class="mt-30 hidden-md-up"></div>
                    <h2>Busque, seleccione, compre en línea.</h2>
                    <p>Todos nuestros productos son de la mejor calidad precio, nuestro enfoque en su salud es por ello que que siempre enfocaremos nuestro mayor esfuerzo en nuestros clientes.</p><a class="text-medium text-decoration-none" href="{{ route('catalogo') }}">Ver productos&nbsp;<i class="icon-arrow-right"></i></a>
                </div>
            </div>
            <hr>
            <div class="row align-items-center padding-top-2x padding-bottom-2x">
                <div class="col-md-5 order-md-2"><img class="d-block w-270 m-auto" src="{{ asset('img/features/02.jpg') }}" alt="Delivery"></div>
                <div class="col-md-7 order-md-1 text-md-left text-center">
                    <div class="mt-30 hidden-md-up"></div>
                    <h2>Entrega rápida en todo el Departamento del El Progreso.</h2>
                    <p>Reparto a domicilio, calidad precio, servicio especializado y en constante mejora, somos por excelencia la mejor opción para tú SALUD.</p><a class="text-medium text-decoration-none" href="#">Detalles de envío&nbsp;<i class="icon-arrow-right"></i></a>
                </div>
            </div>
            <hr>
        <div class="row align-items-center padding-top-2x padding-bottom-2x">
                {{-- <div class="col-md-5"><img class="d-block w-270 m-auto" src="{{ asset('img/features/04.jpg') }}" alt="Delivery"></div>
                <div class="col-md-7 order-md-1 text-md-left text-center">
                    <div class="mt-30 hidden-md-up"></div>
                    <h2>Vísitenos en nuestras tiendas</h2>
                    <p>Estamos úbicados en todo el departamento de el Progreso, con gusto te atenderemos..</p><a class="text-medium text-decoration-none" href="{{ route('contacto') }}">Ver contactos&nbsp;<i class="icon-arrow-right"></i></a>
                </div> --}}
                <!-- Page Content -->
  </div>
  <!-- /.container -->
            
            </div>
        <hr>
        </div>
        </div>
    @endsection

    @section('scripts')
      
    @endsection