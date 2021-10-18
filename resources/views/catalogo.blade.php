@extends('plantilla')   
    
    @section('title' , 'Catálogo productos')
    @section('content')
        <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Nuestros productos</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li>
                  <a href="{{ url('home') }}">Inicio</a>
              </li>
            </ul>
          </div>
        </div>
      </div>


      <div class="container padding-bottom-3x mb-1">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <!-- Shop Toolbar-->
            <div class="shop-toolbar padding-bottom-1x mb-2">
              <div class="column">
                <div class="shop-sorting">
                    <span class="text-muted">Mostrando:&nbsp;</span><span>{{ $productos_pagina }} - {{ $total_productos }} productos</span>
                </div>
              </div>
              <div class="column">
                <div class="shop-view">
                    <a class="list-view active" href="shop-list-ns.html">
                        <span></span><span></span><span></span>
                    </a>
                </div>
              </div>
            </div>

            @foreach($productos as $index => $producto)
            <!-- Product-->
            <div class="product-card product-list"><a class="product-thumb" href="{{ route('detalle' , $producto['id']) }}">
                <img src="{{ asset('admin/uploads/productos/' . $producto['imagen']) }}" alt="Product"></a>
                <div class="product-info">
                    <h3 class="product-title">
                        <a href="{{ route('detalle' , $producto['id']) }}">{{ $producto['nombre'] }}</a>
                    </h3>
                    <h4 class="product-price">S/{{ number_format($producto['precio'] , 2, '.', ' ') }}</h4>
                    <p class="hidden-xs-down text-justify">{{ $producto['descripcion'] }}</p>
                    <div class="product-buttons">
                      <button class="btn btn-outline-primary btn-sm btn_agregarcarrito" data-id="{{ $producto['id'] }}" data-cantidad="1">Agregar</button>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="pt-2 text-center">
              <!-- Pagination-->
              {{ $productos->links() }}
            </div>
          </div>
        </div>
      </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('js/funciones_carrito.js') }}"></script>
    @endsection