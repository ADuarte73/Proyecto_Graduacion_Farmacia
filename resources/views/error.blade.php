@extends('plantilla')   
    
    @section('title' , 'Consulta Tracking')
    @section('content')
        <div class="container padding-top-3x padding-bottom-3x mb-1">
            <img class="d-block m-auto" src="{{ asset('img/404_art.jpg') }}" style="width: 90%; max-width: 550px;" alt="404">

            <div class="padding-top-1x text-center">
              <h3>No hay registros con esa órden</h3>
              <a href="{{ route('consulta') }}" class="btn btn-danger">Volver</a>
            </div>
      </div>
    @endsection

    @section('scripts')
      
    @endsection