@extends('plantilla')   
    
    @section('title' , 'Resultado')
    @section('content')  
        <div class="page-title">
            <div class="container">
                <div class="column">
                    <h1>Resultado</h1>
                </div>
            <div class="column">
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Resultados</li>
            </ul>
            </div>
        </div>

        <div class="container padding-bottom-3x mb-2 mt-3">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                
                @if(!$resultados->isEmpty())
                @foreach($resultados as $resultado)
                <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex"><a class="pr-4 hidden-xs-down" href="{{ route('detalle' , $resultado['id']) }}" style="max-width: 150px;"><img src="{{ asset('admin/uploads/productos/' . $resultado['imagen']) }}" alt="Product"></a>
                    <div>
                        <h5><a class="navi-link" href="{{ route('detalle' , $resultado['id']) }}">{{ $resultado['nombre'] }}</a></h5>
                        <h6>
                        S/{{ number_format($resultado['precio'] , 2 , '.', ' ') }}
                        </h6>
                        <p>
                            {{ $resultado['descripcion'] }}
                        </p>
                    </div>
                    </div>
                </div>
                </div>
                @endforeach
                @else
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5>No se encontraron coincidencias, intente de nuevo</h5>
                    </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
      
    @endsection