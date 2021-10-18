<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/waitMe.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element text-center">
                                <img alt="image" class="rounded-circle" style="widows: 48px; height: 48px;" src="{{ asset('admin/img/perfil.png') }}"/>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold text-uppercase">
                                        {{ session('usuario')['nombre'] }}
                                    </span>
                                </a>
                            </div>
                            <div class="logo-element">
                                FS
                            </div>
                        </li>

                        <li>
                            <a href="{{ route('admin') }}"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a>
                        </li>

                        <li>
                            <a href="{{ route('ordenes') }}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Órdenes</span></a>
                        </li>

                        <li>
                            <a href="{{ route('admin.productos') }}"><i class="fa fa-tags"></i> <span class="nav-label">Productos</span></a>
                        </li>

                        <li>
                            <a href="{{ route('admin.comentarios') }}"><i class="fa fa-commenting"></i> <span class="nav-label">Blog</span></a>
                        </li>

                        <li>
                            <a href="{{ route('admin.configuracion') }}"><i class="fa fa-cogs"></i> <span class="nav-label">Configuración</span></a>
                        </li>
                    </nav>

                    <div id="page-wrapper" class="gray-bg">
                        <div class="row border-bottom">
                            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                                <div class="navbar-header">
                                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                                    <form role="search" class="navbar-form-custom" action="search_results.html">
                                    </form>
                                </div>
                                <ul class="nav navbar-top-links navbar-right">
                                    <li>
                                        <a href="{{ route('cerrar_sesion') }}">
                                            <i class="fa fa-sign-out"></i>Cerrar sesión
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="wrapper wrapper-content">
                            @yield('content')
                            
                        </div>


                        <div class="footer">
                            <div class="float-right">
                                Todos los derechos reservados
                            </div>
                            <div>
                                <strong>Copyright</strong> Angel Duarte &copy; {{ date('Y') }}
                            </div>
                        </div>
                    </div>
                    <div id="right-sidebar">
                        <div class="sidebar-container">
                            <ul class="nav nav-tabs navs-3">
                                <li>
                                    <a class="nav-link active" data-toggle="tab" href="#tab-1"> Notes </a>
                                </li>
                                <li>
                                    <a class="nav-link" data-toggle="tab" href="#tab-2"> Projects </a>
                                </li>
                                <li>
                                    <a class="nav-link" data-toggle="tab" href="#tab-3"> <i class="fa fa-gear"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Mainly scripts -->
                <script src="{{ asset('admin/js/jquery-3.1.1.min.js') }}"></script>
                <script src="{{ asset('admin/js/popper.min.js') }}"></script>
                <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
                <!-- Flot -->
                <script src="{{ asset('admin/js/plugins/flot/jquery.flot.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/flot/jquery.flot.spline.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/flot/jquery.flot.resize.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/flot/jquery.flot.pie.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/flot/jquery.flot.time.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
                <!-- Peity -->
                <script src="{{ asset('admin/js/plugins/peity/jquery.peity.min.js') }}"></script>
                <script src="{{ asset('admin/js/demo/peity-demo.js') }}"></script>
                <!-- Custom and plugin javascript -->
                <script src="{{ asset('admin/js/inspinia.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/pace/pace.min.js') }}"></script>
                <!-- jQuery UI -->
                <script src="{{ asset('admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
                <!-- Jvectormap -->
                <script src="{{ asset('admin/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
                <!-- EayPIE -->
                <script src="{{ asset('admin/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>
                <!-- Sparkline -->
                <script src="{{ asset('admin/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
                <!-- Sparkline demo data  -->
                <script src="{{ asset('admin/js/demo/sparkline-demo.js') }}"></script>
                <script src="{{ asset('js/waitMe.min.js') }}"></script>
                <script src="{{ asset('js/toastr.min.js') }}"></script>
                <script src="{{ asset('admin/js/plugins/fullcalendar/moment.min.js') }}"></script>
                <script src="{{ asset('js/global.js') }}"></script>
                @yield('scripts')
            </body>
        </html>