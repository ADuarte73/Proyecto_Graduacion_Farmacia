@extends('plantilla')   
    
    @section('title' , 'Consulta Tracking')
    @section('content')
        <div class="page-title">
            <div class="container">
                <div class="column">
                <h1>Consulta Tracking</h1>
                </div>
                <div class="column">
                    <ul class="breadcrumbs">
                      <li>
                        <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="separator">&nbsp;</li>
                      <li>
                        <a href="">Consulta Tracking</a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="container padding-bottom-3x mb-1">
            <div class="card text-center">
              <div class="card-body">
                <h3 class="card-title">
                    Ingrese el número de Tracking de su órden
                </h3>
                <form action="{{ route('tracking') }}" method="POST" class="row">
                    @csrf
                    <div class="col-md-6 offset-md-3">
                        <input type="text" class="form-control text-uppercase" name="tracking">
                        @error('orden') 
                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                        @enderror

                        <button class="btn btn-primary">Consultar ahora</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    @endsection

    @section('scripts')
      
    @endsection