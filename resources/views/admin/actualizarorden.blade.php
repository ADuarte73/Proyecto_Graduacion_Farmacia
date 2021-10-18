@extends('plantilla_admin')

    @section('title' , 'Editar orden')
    @section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Actualizar orden</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('ordenes') }}">Órdenes</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Actualizar orden</a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Actualizar orden</h5>
                        </div>

                        <div class="ibox-content">
                            <form action="{{ route('store_orden') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total" class="col-form-label">Estado:</label>
                                            <select name="estado" id="estado" class="form-control">
                                                @foreach($estados as $index => $estado)
                                                    <option value="{{ $estado['id'] }}" {{ ($estado['id'] == $orden->estado) ? 'selected' : '' }}>{{ $estado['estado'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cliente" class="col-form-label">Cliente:</label>
                                            <input type="text" id="cliente" class="form-control" value="{{ $orden->cliente }}" name="cliente" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">Email:</label>
                                            <input type="text" id="email" class="form-control" value="{{ $orden->email }}" name="email" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="telefono" class="col-form-label">Teléfono:</label>
                                            <input type="text" id="telefono" class="form-control" value="{{ $orden->telefono }}" id="telefono" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="direccion" class="col-form-label">Dirección:</label>
                                            <textarea id="direccion" class="form-control" cols="10" rows="5" name="direccion" readonly>{{ $orden->direccion }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="referencia" class="col-form-label">Referencia:</label>
                                            <textarea id="referencia" class="form-control" cols="10" rows="5" name="referencia" readonly>{{ $orden->referencia }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total" class="col-form-label">Total Q.:</label>
                                            <input type="text" id="total" class="form-control" value="{{ number_format($orden->total, 2, '.', ' ') }}" id="total" readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="orden" class="col-form-label">Órden N°:</label>
                                            <input type="text" id="orden" class="form-control" value="{{ $orden->id }}" name="orden" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block btn_editarproducto">Guardar</button>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <a href="{{ route('ordenes') }}" class="btn btn-danger btn-block">Volver</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            let notificacion = "{{ session('notificacion') }}";
            if(notificacion)
            {
                message_toast('success' , notificacion);
            }
        </script>
    @endsection