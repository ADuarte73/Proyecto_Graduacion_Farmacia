@extends('plantilla')   
    
    @section('title' , 'Funko Store')
    @section('content')
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Confirmación</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="{{ url('home') }}">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Confirmación</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="container padding-bottom-3x mb-2">
        <div class="card text-center">
          <div class="card-body padding-top-2x">
            <h3 class="card-title">¡Gracias por su compra!</h3>
            <p class="card-text">Su pedido ha sido realizado y será procesado lo antes posible.</p>
            <p class="card-text">Asegúrese de anotar su número de pedido, que es <span class="text-medium">{{ $tracking }}</span></p>
            <p class="card-text">En breve recibirás un correo electrónico con la confirmación de tu pedido. 
              <u>Puedes ahora:</u>
            </p>
            <div class="padding-top-1x padding-bottom-1x">
              <a class="btn btn-outline-secondary" href="{{ route('catalogo') }}">Seguir comprando</a>
              <a class="btn btn-outline-primary" href="{{ route('consulta') }}"><i class="icon-location"></i>&nbsp;Tracking</a></div>
          </div>
        </div>
      </div>
    @endsection

    
    @section('scripts')
        <script src="{{ asset('js/funciones_carrito.js') }}"></script>
    @endsection