@extends('plantilla')   
    
    @section('title' , 'Nuestro blog')
    @section('content')  
        <div class="page-title">
            <div class="container">
                <div class="column">
                <h1>Nuestro blog</h1>
                </div>
                <div class="column">
                    <ul class="breadcrumbs">
                      <li>
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="separator">&nbsp;</li>
                      <li>
                        <a href="">Blog</a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>    

        <div class="container padding-bottom-3x mb-2">
            <div class="row justify-content-center">
                <section id="comments">
                    @if(!$comentarios->isEmpty())
                    <!-- Comment-->
                    <div id="registros_blog">
                        @foreach($comentarios as $index => $comentario)
                        <div class="comment">
                            <div class="comment-author-ava"><img src="{{ asset('img/user.jpg') }}" alt="Usuario comentario"></div>
                            <div class="comment-body">
                                <div class="comment-header">
                                    <h4 class="comment-title">{{ $comentario['nombre'] }}</h4>
                                </div>
                                <p class="comment-text">{{ $comentario['comentario'] }}</p>
                                <div class="comment-footer">
                                    <div class="column">
                                        <span class="comment-meta">{{ date('d-m-Y' , strtotime($comentario['fecha'])) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="text-center pagination">
                            {{ $comentarios->links() }}
                        </div>
                    </div>

                    <div class="text-center mt-2">
                        <a class="btn btn-outline-secondary margin-top-none" href="{{ url('contacto') }}">Escribir un comentario</a>
                    </div>
                        
                    @else
                        <div class="ml-3">
                            <img class="d-block m-auto" src="{{ asset('img/404_art.jpg') }}" style="width: 100%; max-width: 550px;" alt="404">
                            <p class="text-center font-weight-bold">Aun no hay comentarios por mostrar</p>
                        </div>
                    @endif
                </section> 
            </div>            
        </div>   
    @endsection

    @section('scripts')
      
    @endsection