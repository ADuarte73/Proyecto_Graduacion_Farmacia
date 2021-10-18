@extends('plantilla')   
    @section('title' , 'Checkout')
    @section('content')  
        <div class="page-title">
            <div class="container">
                <div class="column">
                <h1>Checkout</h1>
                </div>
                <div class="column">
                    <ul class="breadcrumbs">
                      <li>
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="separator">&nbsp;</li>
                      <li>
                        <a href="">Checkout</a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>    

          
        <div class="container padding-bottom-3x mb-2">
        <div class="row">
          <!-- Checkout Adress-->
          <div class="col-xl-9 col-lg-8">
            <div id="wrapper_checkout">
                <h4>Dirección de envío</h4>
                <hr class="padding-bottom-1x">
                <form id="form_direccion" action="">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="checkout-fn">Nombres</label>
                      <input class="form-control" type="text" id="checkout-fn" name="nombres">
                      <div class="invalid-feedback">El campo no debe estar vacío</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="checkout-ln">Apellidos</label>
                      <input class="form-control" type="text" id="checkout-ln" name="apellidos">
                      <div class="invalid-feedback">El campo no debe estar vacío</div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="checkout-email">Email</label>
                      <input class="form-control" type="email" id="checkout-email" name="email">
                      <div class="invalid-feedback">El campo no debe estar vacío</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="checkout-phone">Teléfono</label>
                      <input class="form-control" type="text" id="checkout-phone" name="telefono">
                      <div class="invalid-feedback">El campo no debe estar vacío</div>
                    </div>
                  </div>
                </div>

                <div class="row padding-bottom-1x">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="checkout-address1">Dirección</label>
                      <input class="form-control" type="text" id="checkout-address1" name=direccion>
                      <div class="invalid-feedback">El campo no debe estar vacío</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="checkout-address2">Referencia</label>
                      <input class="form-control" type="text" id="checkout-address2" name="referencia">
                      <div class="invalid-feedback">El campo no debe estar vacío</div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="checkout-footer">
              <div class="column">
                    <a class="btn btn-outline-secondary" href="{{ route('carrito') }}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Volver al carrito</span></a>
              </div>

              <div id="wrapper_continuar" class="column">
                    <a class="btn btn-primary btn_continuar" href=""><span class="hidden-xs-down">Continuar&nbsp;</span><i class="icon-arrow-right"></i></a>
              </div>
            </div>
            </form>
          </div>
          <!-- Sidebar          -->
          <div class="col-xl-3 col-lg-4">
            <aside class="sidebar">
              <div class="padding-top-2x hidden-lg-up"></div>
              <!-- Order Summary Widget-->
              <section id="orden_sumario" class="widget widget-order-summary"></section>
            </aside>
          </div>
        </div>
      </div>


    @endsection

    @section('scripts')
        <script>
            var html = '';
            function cargar_totales_checkout()
            {
                $.ajax({
                    url         : url + '/total_checkout',
                    method      : 'POST',
                    data        : {
                        '_token' : token
                    },
                    success     : function(r) {
                        if(!r.estado) {
                            message_toast(r.mensaje);
                            return;
                        }

                        $('#orden_sumario').html(r.orden_sumario);
                    },
                    dataType    : 'json'
                });
            }

            cargar_totales_checkout();

            /*
                Dirección de envío
            */
            
            
            $('body').on('click' , '.btn_continuar' , function(e) {
                e.preventDefault();
                let nombres     = $('input[name="nombres"]').val(),
                    apellidos   = $('input[name="apellidos"]').val(),
                    email       = $('input[name="email"]').val(),
                    telefono    = $('input[name="telefono"]').val(),
                    direccion   = $('input[name="direccion"]').val(),
                    referencia  = $('input[name="referencia"]').val(),
                    form        = $('#form_direccion').serialize();

                    if(nombres == '')
                    {
                        $('input[name="nombres"]').addClass('is-invalid');
                    }
                    else
                    {
                        $('input[name="nombres"]').removeClass('is-invalid');
                    }

                    if(apellidos == '')
                    {
                        $('input[name="apellidos"]').addClass('is-invalid');
                    }
                    else
                    {
                        $('input[name="apellidos"]').removeClass('is-invalid');
                    }

                    if(email == '')
                    {
                        $('input[name="email"]').addClass('is-invalid');
                    }
                    else
                    {
                        $('input[name="email"]').removeClass('is-invalid');
                    }

                    if(telefono == '')
                    {
                        $('input[name="telefono"]').addClass('is-invalid');
                    }
                    else
                    {
                        $('input[name="telefono"]').removeClass('is-invalid');
                    }

                    if(direccion == '')
                    {
                        $('input[name="direccion"]').addClass('is-invalid');
                    }
                    else
                    {
                        $('input[name="direccion"]').removeClass('is-invalid');
                    }

                    if(referencia == '')
                    {
                        $('input[name="referencia"]').addClass('is-invalid');
                    }
                    else
                    {
                        $('input[name="referencia"]').removeClass('is-invalid');
                    }

                    if(nombres != '' &&
                        apellidos != '' &&
                        email != '' &&
                        telefono != '' &&
                        direccion != '' &&
                        referencia != '')
                    {

                        $.ajax({
                            url         : "{{ route('direccion_envio') }}",
                            method      : 'POST',
                            data        : form,
                            success     : function(r)
                            {
                                if(!r.estado)
                                {
                                    message_toast('error' , r.mensaje);
                                    return;
                                }

                                window.location.href = "{{ route('pagar') }}";
                            },
                            dataType    : 'json'
                        });

                    }
            });

        </script>
    @endsection