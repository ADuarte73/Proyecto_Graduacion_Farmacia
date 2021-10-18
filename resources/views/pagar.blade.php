@extends('plantilla')   
    @section('title' , 'Pagar')
    @section('content')  
    @php
        // SDK de Mercado Pago
        require base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));


        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        foreach(session('cart')['productos'] as $index => $producto)
        {
            $item             = new MercadoPago\Item();
            $item->title      = strtoupper($producto['nombre']);
            $item->quantity   = $producto['cantidad'];
            $item->unit_price = $producto['precio'];

            $productos[]      = $item;
        }

        $preference->back_urls = array(
            "success" => route('pago')
        );
        $preference->auto_return = "approved";

        $preference->items = $productos;
        $preference->save();

    @endphp

    <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Revise su órden</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="{{ route('checkout') }}">Checkout</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Revise su órden</li>
            </ul>
          </div>
        </div>
      </div>

    <div class="container padding-bottom-3x mb-2">
    <div class="row">
        <hr class="padding-bottom-1x">
        <div class="table-responsive shopping-cart">
              <table class="table">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th class="text-center">Subtotal</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach(session('cart')['productos'] as $producto)
                  <tr>
                    <td>
                      <div class="product-item">
                        <a class="product-thumb" href="{{ route('detalle' , $producto['id']) }}">
                            <img src="{{ asset('admin/uploads/imagen_referencia/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}">
                        </a>
                        <div class="product-info align-middle">
                            <h4 class="product-title text-uppercase">
                                {{ $producto['nombre'] }}<small>x {{ $producto['cantidad'] }}</small>
                            </h4>
                        </div>
                      </div>
                    </td>
                    <td class="text-center text-lg text-medium">Q/{{ number_format(($producto['precio'] * $producto['cantidad']) , 2, '.', ' ') }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            

            <div class="shopping-cart-footer">
              <div class="column"></div>
              <div class="column text-lg">Envío: <span class="text-medium">Q/{{ number_format(session('cart')['envio'], 2 , '.', ' ') }}</span></div>
            </div>

            <div class="shopping-cart-footer">
              <div class="column"></div>
              <div class="column text-lg">Total: <span class="text-medium">Q/{{ number_format(session('cart')['total'], 2 , '.', ' ') }}</span></div>
            </div>

            <div class="checkout-footer margin-top-1x">
              <div class="column hidden-xs-down"><a class="btn btn-outline-secondary" href="{{ route('checkout') }}"><i class="icon-arrow-left"></i>&nbsp;Volver</a></div>
              <div class="column"><div class="cho-container"></div></div>
            </div>

        </div>
        </div>    

    @endsection

    @section('scripts')
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        // Agrega credenciales de SDK
        const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
                    locale: 'es-AR'
        });

              // Inicializa el checkout
        mp.checkout({
                  preference: {
                      id: "{{ $preference->id }}"
                  },
                  render: {
                        container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                        label: 'Pagar ahora', // Cambia el texto del botón de pago (opcional)
                  }
        });
    </script>
    @endsection

