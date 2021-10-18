<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/waitMe.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
</head>



<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-bold">Bienvenido a Farmacia San Jose</h2>
                <p>
                    Desde este apartado usted podra gestionar la información de su tienda.
                </p>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Usuario" name="usuario" value="admin@funkostore.com">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Contraseña" name="clave" value="admin123">
                        </div>

                        <button type="submit" class="btn btn-primary block full-width m-b btn_login">
                            Iniciar sesión <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </button>
                    </form>
                    <p class="m-t text-center">
                        <small>Desarrollado por Angel Duarte &copy;  - {{ date('Y') }}</small>
                    </p>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('admin/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/waitMe.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>

    <script>
        $('body').on('click'  , '.btn_login' , function(e)
        {
            e.preventDefault();
            let usuario     = $('input[name="usuario"]').val(), 
                clave       = $('input[name="clave"]').val();

                if(usuario == '' || clave == '')
                {
                    message_toast('error', 'El campo no debe quedar vacío', '');
                    return;
                } 

                $.ajax({
                    url         : "{{ route('login_sesion') }}",
                    method      : 'POST',
                    data        : {
                        '_token' : "{{ csrf_token() }}" , usuario : usuario, clave : clave
                    },
                    beforeSend  : function() {
                        $('body').waitMe({
                            effect   : 'rotation'
                        });
                    },
                    success     : function(r) {
                        if(!r.estado){
                            $('body').waitMe('hide');
                            message_toast('error', r.mensaje, '');
                            return;
                        }

                        $('body').waitMe('hide');
                        window.location.href = "{{ route('admin') }}";
                    },
                    dataType    : 'json'
                });

        });
    </script>
</body>
</html>