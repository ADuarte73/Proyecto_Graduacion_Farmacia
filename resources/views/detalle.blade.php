@extends('plantilla')   
    
    @section('title' , 'Detalle de producto')
    @section('content')
        <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Detalle de producto</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="index.html">Home</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>
                <a href="{{ route('catalogo') }}">Catálogo</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Detalle de producto</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-1">
        <div class="row">
          <!-- Poduct Gallery-->
          <div class="col-md-6">
            <div class="product-gallery">
                
                <div class="product-carousel owl-carousel gallery-wrapper">
                    @foreach($imagenes as $index => $imagen)
                    <div class="gallery-item" data-hash="{{ $index }}">
                        <a href="{{ asset('admin/uploads/productos/' . $imagen['imagen']) }}" data-size="800x900">
                            <img src="{{ asset('admin/uploads/productos/' . $imagen['imagen']) }}" alt="Product" style="width: 400px;" class="mx-auto">
                        </a>
                    </div>
                    @endforeach
                </div>
                

                <ul class="product-thumbnails">
                    @foreach($imagenes as $index => $imagen)
                        <li class="active">
                            <a href="#{{ $index }}">
                                <img src="{{ asset('admin/uploads/productos/' . $imagen['imagen']) }}" alt="Product" style="width: 80px;">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
          </div>

          <!-- Product Info-->
          <div class="col-md-6">
            <div class="padding-top-2x mt-2 hidden-md-up"></div>
            <h2 class="padding-top-1x text-normal">{{ $producto['nombre'] }}</h2>
            <span class="h2 d-block">Q/{{ number_format($producto['precio'], 2, '.' , ' ') }}</span>
            <p class="text-justify">{{ $producto['descripcion'] }}</p>
            <div class="row margin-top-1x">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="quantity">Cantidad</label>
                  <select class="form-control" id="quantity">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
              </div>
            </div>
            <hr class="mb-3">
            <div class="d-flex flex-wrap justify-content-between">
              <div class="sp-buttons mt-2 mb-2">
                <button class="btn btn-primary btn_agregarcarrito" data-id="{{ $producto['id'] }}" data-cantidad="1">
                    <i class="icon-bag"></i> AGREGAR
                </button>

                <a href="{{ route('catalogo') }}" class="btn btn-danger">REGRESAR</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Photoswipe container-->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="pswp__bg"></div>
      <div class="pswp__scroll-wrap">
        <div class="pswp__container">
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
          <div class="pswp__top-bar">
            <div class="pswp__counter"></div>
            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
            <button class="pswp__button pswp__button--share" title="Share"></button>
            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
            <div class="pswp__preloader">
              <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                  <div class="pswp__preloader__donut"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip"></div>
          </div>
          <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
          <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
          <div class="pswp__caption">
            <div class="pswp__caption__center"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>
    @endsection
    @section('scripts')
        <script src="{{ asset('js/funciones_carrito.js') }}"></script>
    @endsection