@extends('plantilla')   
    
    @section('title' , 'Farmacia San Jóse')
    @section('content')

        <!-- Main Slider-->
      <section class="hero-slider" style="background-image: url(img/hero-slider/main-bg.jpg);">
        <div class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000 }">

          {{-- <div class="item">
            <div class="container padding-top-1x">
              <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                  <div class="from-bottom">
                    <div class="h2 text-body text-normal mb-2 pt-1">Medicamento1</div>
                    <div class="h3 text-body text-normal mb-4 pb-1">Por solo <span class="text-bold">Q 65.00</span></div>
                  </div><a class="btn btn-primary scale-up delay-1" href="{{ route('catalogo') }}">Ver catálogo</a>
                </div>
                <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" style="width: 500px; height: 500px;" src="img/hero-slider/goku.png" alt="Puma Backpack"></div>
              </div>
            </div>
          </div>

          <div class="item">
            <div class="container padding-top-1x">
              <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                  <div class="from-bottom">
                    <div class="h2 text-body text-normal mb-2 pt-1">Medicamento2</div>
                    <div class="h3 text-body text-normal mb-4 pb-1">Por solo <span class="text-bold">Q 65.00</span></div>
                  </div><a class="btn btn-primary scale-up delay-1" href="{{ route('catalogo') }}">Ver catálogo</a>
                </div>
                <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" style="width: 500px; height: 500px;" src="img/hero-slider/naruto.png" alt="Chuck Taylor All Star II"></div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="container padding-top-1x">
              <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                  <div class="from-bottom">
                    <div class="h2 text-body text-normal mb-2 pt-1">Medicamento3</div>
                    <div class="h3 text-body text-normal mb-4 pb-1">Por solo <span class="text-bold">Q65.00</span></div>
                  </div><a class="btn btn-primary scale-up delay-1" href="{{ route('catalogo') }}">Ver catálogo</a>
                </div>
                <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="img/hero-slider/joker.png" alt="Moto 360"></div>
              </div>
            </div>
          </div> --}}
        </div>
      </section>


      <!-- Nuestros productos Carousel-->
      <section class="container padding-top-3x padding-bottom-3x">
        <h3 class="text-center mb-30">Nuestros productos</h3>
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">


        @foreach($productos as $producto)
          <!-- Producto-->
          <div class="grid-item">
            <div class="product-card">
                <a class="product-thumb" href="{{ route('detalle' , $producto['id']) }}">
                    <img src="{{ asset('admin/uploads/productos/' . $producto['imagen']) }}" alt="Product">
                </a>
                <h3 class="product-title text-uppercase"><a href="{{ route('detalle' , $producto['id']) }}">{{ $producto['nombre'] }}</a></h3>
                <h4 class="product-price">
                    Q/{{ number_format($producto['precio'] , 2, '.' ,' ') }}
                </h4>
                <div class="product-buttons">
                    <button class="btn btn-outline-primary btn-sm btn_agregarcarrito" data-id="{{ $producto['id'] }}" data-cantidad="1">Agregar</button>
                </div>
            </div>
          </div>
           <!-- Fin Producto-->
        @endforeach
        </div>

        <div class="text-center mt-2">
            <a class="btn btn-outline-secondary margin-top-none" href="{{ url('catalogo') }}">Ver todos los productos</a>
        </div>
      </section>

     
      <!-- Services-->
      <section class="container padding-bottom-2x">
        <div class="row">
          <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="img/services/01.png" alt="Shipping">
            <h6>Envío gratis a todo el país</h6>
            <p class="text-muted margin-bottom-none">Envío gratuito para todos los pedidos superiores a Q 100.00</p>
          </div>
          <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="img/services/02.png" alt="Money Back">
            <h6>Garantía de devolución del dinero</h6>
            <p class="text-muted margin-bottom-none">Devolvemos el dinero en un plazo de 7 días.</p>
          </div>
          <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="img/services/03.png" alt="Support">
            <h6>Atención al cliente 24 horas al día</h6>
            <p class="text-muted margin-bottom-none">Atención al cliente amigable las 24 horas</p>
          </div>
          <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="img/services/04.png" alt="Payment">
            <h6>Pago seguro en línea</h6>
            <p class="text-muted margin-bottom-none">Poseemos SSL / Certificado seguro</p>
          </div>
        </div>
      </section>
    @endsection

    
    @section('scripts')
        <script src="{{ asset('js/funciones_carrito.js') }}"></script>
    @endsection