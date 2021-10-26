@extends('plantilla')   
    
    @section('title' , 'Nuestro blog')
    @section('content')  
        <div class="page-title">
            <div class="container">
                <div class="column">
                <h1>Contacto</h1>
                </div>
                <div class="column">
                    <ul class="breadcrumbs">
                      <li>
                        <a href="{{ route('home') }}">Inicio</a>
                      </li>
                      <li class="separator">&nbsp;</li>
                      <li>
                        <a href="">Contacto</a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>    

        <div class="container padding-bottom-2x mb-2">
        <div class="row">
          <div class="col-md-7">
            <div class="display-3 text-muted opacity-75 mb-30">
                Atención al cliente
            </div>
          </div>
          <div class="col-md-5">
            <ul class="list-icon">
              <li> <i class="icon-mail"></i><a class="navi-link" href="mailto:customer.service@unishop.com">atencion@farmaciasanjose.com.gt</a></li>
              <li> <i class="icon-bell"></i>+502 79450000</li>
              <li> <i class="icon-clock"></i>1 - 2 business days</li>
            </ul>
          </div>
        </div>
        <hr class="margin-top-2x">
        <div class="row margin-top-2x">
          <div class="col-md-7">
            <div class="display-3 text-muted opacity-75 mb-30">
                Soporte técnico
            </div>
          </div>
          <div class="col-md-5">
            <ul class="list-icon">
              <li> <i class="icon-mail"></i><a class="navi-link" href="mailto:support@unishop.com">info@farmaciasanjose.com.gt</a></li>
              <li> <i class="icon-bell"></i>+502 77000000</li>
              <li> <i class="icon-clock"></i>1 - 2 business days</li>
            </ul>
          </div>
        </div>

        <hr class="margin-top-2x">
        
        <h2 class="padding-bottom-1x mt-5">Déjanos un comentario</h2>
            <form id="form_comentarios" class="row" method="post">
                @csrf
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="comment-name">Nombre</label>
                        <input class="form-control form-control-rounded" type="text" id="comment-name" placeholder="Tu nombre" name="nombre">
                        <span class="invalid-feedback">El campo no debe estar vacío</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="comment-email">E-mail</label>
                        <input class="form-control form-control-rounded" type="email" id="comment-email" placeholder="tuemail@email.com" name="email">
                        <span class="invalid-feedback">El campo no debe estar vacío</span>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="comment-text">Comentario</label>
                        <textarea class="form-control form-control-rounded" rows="7" id="comment-text" placeholder="Escribe tu comentario aquí..." name="comentario"></textarea>
                        <span class="invalid-feedback">El campo no debe estar vacío</span>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button class="btn btn-pill btn-primary btn_comentario" type="submit">Publicar comentario</button>
                </div>
            </form>
      </div>   



    @endsection

    @section('scripts')
        <script>
            $('footer').addClass('mt-5');

            $('body').on('click' , '.btn_comentario' , function(e) {
                e.preventDefault();
                let form = $('#form_comentarios').serialize();

                if($('input[name="nombre"]').val() == '')
                {
                    $('input[name="nombre"]').addClass('is-invalid');   
                }
                else {
                    $('input[name="nombre"]').removeClass('is-invalid');
                }

                if($('input[name="email"]').val() == '')
                {
                    $('input[name="email"]').addClass('is-invalid');   
                }
                else {
                    $('input[name="email"]').removeClass('is-invalid');
                }

                if($('textarea[name="comentario"]').val() == '')
                {
                    $('textarea[name="comentario"]').addClass('is-invalid');   
                }
                else {
                    $('textarea[name="comentario"]').removeClass('is-invalid');
                }


                if($('input[name="nombre"]').val() != '' && 
                    $('input[name="email"]').val() != '' && 
                    $('textarea[name="comentario"]').val() != '')
                    {
                        $.ajax({
                            url         : "{{ route('agregar_comentario') }}",
                            method      : 'POST',
                            data        : form,
                            beforeSend  : function(){
                                $('body').waitMe({
                                    effect   : 'rotateplane'
                                });
                            },
                            success     : function(r) {
                                if(!r.estado) 
                                {
                                    $('body').waitMe('hide');
                                    message_toast('warning' , r.mensaje);
                                    return;
                                }   

                                $('body').waitMe('hide');
                                $('#form_comentarios').trigger('reset');
                                message_toast('success' , r.mensaje);
                            },
                            dataType    : 'json' 
                        });
                    }
            });
        </script>   
    @endsection