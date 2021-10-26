@extends('plantilla')   
    
    @section('title' , 'Cart')
    @section('content')  

    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title">
        <div class="container">
          <div class="column">
            <h1>Carrito</h1>
          </div>
          <div class="column">
            <ul class="breadcrumbs">
              <li><a href="{{ url('home') }}">Inicio</a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>Carrito</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Page Content-->
        <div id="wrapper_carrito" class="container padding-bottom-3x mb-1"></div>
    @endsection

    @section('scripts')
        <script>
            function cargar_carrito()
            {
                $.ajax({
                    url       : "{{ route('cargar_carrito') }}",
                    method    : 'POST', 
                    data      : {
                        '_token' : "{{ csrf_token() }}"
                    },
                    success   : function(r){
                        if(!r.estado)
                        {
                            message_toast('error' , r.mensaje);
                            return;
                        }

                        $('#wrapper_carrito').html(r.carrito);
                    },
                    dataType  : 'json'
                });
            }

            cargar_carrito();


        $('body').on('click', '.btn_limpiarcarrito' , function(e) {
            e.preventDefault();

            $.ajax({
                url         : "{{ route('removercarrito') }}",
                method      : 'POST',
                data        : {
                    '_token' : "{{ csrf_token() }}"
                },
                beforeSend  : function() {
                    $('body').waitMe({
                        effect : 'ios'
                    });
                },
                success     : function(r) {
                    if(!r.estado) {
                        $('body').waitMe('hide');
                        message_toast('error' , r.mensaje);
                        return;
                    }

                    $('body').waitMe('hide');
                    message_toast('success' , r.mensaje);
                    load_cantproductscart();
                    total_carrito();
                    cargar_toolbarcarrito();
                    cargar_carrito();

                },
                dataType    : 'json'
            });
        });
        </script>   
    @endsection