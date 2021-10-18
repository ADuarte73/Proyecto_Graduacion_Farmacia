<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Unishop - Universal E-Commerce Template">
    <meta name="keywords" content="shop, e-commerce, modern, flat style, responsive, online store, business, mobile, blog, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Rokaux">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="url" content="{{ url('/') }}">
    <meta name="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" media="screen" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('css/card.min.css') }}">
    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('css/styles.min.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('customizer/customizer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/waitMe.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <script>
      (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-T4DJFPZ');
    </script>
    <script src="{{ asset('js/modernizr.min.js') }}"></script>


    
  </head>
  <!-- Body-->
  <body>
    <!-- Google Tag Manager (noscript)-->
    <noscript>
      <iframe src="../../../ns.html?id=GTM-T4DJFPZ" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
    </noscript>
    <!-- Template Customizer-->
    <div class="customizer-backdrop"></div>

    <!-- Topbar-->
    <div class="topbar">
      <div class="topbar-column"></div>
      <div class="topbar-column">
        <a class="hidden-md-down" href="mailto:support@funkostore.com"><i class="icon-mail"></i>&nbsp; {{ $configinfo ? $configinfo->email : '' }}</a>
        <a class="hidden-md-down" href="tel:00331697720"><i class="icon-bell"></i>&nbsp; +51 {{ $configinfo ? $configinfo->telefono : '-' }}</a> &nbsp;&nbsp;&nbsp;&nbsp;
        <a class="social-button sb-facebook shape-none sb-dark" href="#" target="_blank"><i class="socicon-facebook"></i></a>
        <a class="social-button sb-twitter shape-none sb-dark" href="#" target="_blank"><i class="socicon-twitter"></i></a>
        <a class="social-button sb-instagram shape-none sb-dark" href="#" target="_blank"><i class="socicon-instagram"></i></a>
      </div>
    </div>

    <!-- Off-Canvas Mobile Menu-->
    <div class="offcanvas-container" id="mobile-menu">
      <nav class="offcanvas-menu">
        <ul class="menu">
            <li class="has-children">
                <span>
                    <a href="{{ route('nosotros') }}"><span>Nosotros</span></a>
                </span>
            </li>

            <li class="has-children">
                <span>
                    <a href="{{ route('blog') }}"><span>Blog</span></a>
                </span>
            </li>

            <li class="has-children">
                <span>
                    <a href="{{ route('contacto') }}"><span>Contacto</span></a>
                </span>
            </li>

            <li class="has-children">
                <span>
                    <a href="{{ route('consulta') }}"><span>Tracking</span></a>
                </span>
            </li>
            
            <li class="has-children">
                <span>
                    <a href=""><span>Carrito</span></a>
                </span>
            </li>

            <li class="has-children">
                <span>
                    <a href="{{ route('login') }}"><span>Login</span></a>
                </span>
            </li>

        </ul>
      </nav>
    </div>

    <!-- Navbar-->
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    <header class="navbar navbar-sticky">
      <!-- Search-->
      <form class="site-search" action="{{ route('buscar_producto') }}" method="POST">
        @csrf
        <input type="text" name="busqueda" placeholder="Ingrese el producto que desea buscar...">
        <div class="search-tools">
            <button class="btn">Buscar</button> 
            <span class="close-search"><i class="icon-cross"></i>
            </span>
        </div>
      </form>

      <div class="site-branding">
        <div class="inner">
          <!-- Off-Canvas Toggle (#shop-categories)-->
          <!-- Off-Canvas Toggle (#mobile-menu)-->
          <!-- Site Logo-->
          <a class="offcanvas-toggle menu-toggle" href="#mobile-menu" data-toggle="offcanvas"></a>
          <a class="site-logo" href="{{ url('/') }}">
          @if($configinfo)
          <img src="{{ asset('img/logo/' . $configinfo->logo) }}" alt="Funkoshop">
          @else
          <img src="{{ asset('img/logo/logo2.png') }}" alt="Funkoshop">
          @endif
            
          </a>
        </div>
      </div>
      <!-- Main Navigation-->
      <nav class="site-menu">
        <ul>
          
          <li>
              <a href="{{ route('nosotros') }}"><span>Nosotros</span></a>
          </li>
          
          <li>
              <a href="{{ route('blog') }}"><span>Blog</span></a>
          </li>
          
          <li>
              <a href="{{ route('contacto') }}"><span>Contacto</span></a>
          </li>

          <li>
              <a href="{{ route('consulta') }}"><span>Tracking</span></a>
          </li>
        </ul>
      </nav>
      <!-- Toolbar-->
      <div class="toolbar">
        <div class="inner">
          <div class="tools">
            <div class="search"><i class="icon-search"></i></div>
            <div class="account">
                <a href="{{ route('login') }}"></a><i class="icon-head"></i>
            </div>

            <div class="cart">
              <a href="{{ route('carrito') }}"></a>
              <i class="icon-bag"></i><span class="count cantidad_productos_carrito"></span>
              <span class="subtotal">Q/<span class="subtotal_carrito"></span></span>

              <!-- Toolbar detalle carrito -->
              <div class="toolbar-dropdown wrapper_toobalcarrito"></div>
              <!-- Fin toolbar detalle carrito -->

            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      
      @yield('content')
      <!-- Page Content-->
      <!-- Site Footer-->
      @yield('footer')
      <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <!-- Contact Info-->
              <section class="widget widget-light-skin">
                <h3 class="widget-title">Póngase en contacto con nosotros</h3>
                <p class="text-white">Teléfono: +51{{ $configinfo ? $configinfo->telefono : '-' }}</p>
                <p>
                  <a class="navi-link-light" href="#">{{ $configinfo ? $configinfo->email : '' }}</a>
                </p>

                <a class="social-button shape-circle sb-facebook sb-light-skin" href="#">
                  <i class="socicon-facebook"></i>
                </a>
                
                <a class="social-button shape-circle sb-twitter sb-light-skin" href="#">
                    <i class="socicon-twitter"></i>
                </a>

                <a class="social-button shape-circle sb-instagram sb-light-skin" href="#">
                    <i class="socicon-instagram"></i>
                </a>
              </section>
            </div>
           
            <div class="col-lg-4 col-md-6">
              <!-- About Us-->
              <section class="widget widget-links widget-light-skin">
                <h3 class="widget-title">Sobre nosotros</h3>
                <ul>
                    <li><a href="{{ route('contacto') }}">Contacto</a></li>
                    <li><a href="{{ route('blog') }}">Nuestro blog</a></li>
                </ul>
              </section>
            </div>

            <div class="col-lg-4 col-md-6">
              <!-- Account / Shipping Info-->
              <section class="widget widget-links widget-light-skin">
                <h3 class="widget-title">Información de envío</h3>
                <ul>
                    <li><a href="{{ route('consulta') }}">Tracking</a></li>
                </ul>
              </section>
            </div>
          </div>
          <!-- Copyright-->
          <p class="footer-copyright">© <a href="">Angel Duarte</a></p>
        </div>
      </footer>
    </div>

    
    <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/card.min.js') }}"></script>
    <script src="{{ asset('js/scripts.min.js') }}"></script>
    <script src="{{ asset('customizer/customizer.min.js') }}"></script>
    <script src="{{ asset('js/waitMe.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    @yield('scripts')
  </body>
</html>