@extends('layouts.simple.master')
@section('title', 'Piquete')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Plano Piquete</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Piquete</li> 
    <li class="breadcrumb-item active">Criar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Editar Piquete</h5>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('rpiquete.update', ['id'=>$rpiquete->id]) }}" method="PUT" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label class="col-form-label ">Motorista </label>
                                <input class="form-control" type="text" name="driver" value="{{$rpiquete->motorista}}" placeholder="Enter customer driver" style="background-color: #E9ECEF;  color: #000000"  disabled>
                                @error('driver') <span style="color: red">{{$message}}.</span> @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">cliente </label>
                                <input class="form-control" type="text" name="name_cliente" value="{{$rpiquete->cliente}}" placeholder="Enter customer name_cliente" style="background-color: #E9ECEF;  color: #000000" disabled>
                                @error('name_cliente') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <!-- ssds -->
                            
                            <!-- c -->
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label"> Local origem </label>
                                <input class="form-control" type="text" name="local_origem" min="1" value="{{$rpiquete->local_origem}}" placeholder="local origem" style="background-color: #E9ECEF;  color: #000000" disabled>
                                @error('local_origem') <span style="color: red">{{$message}}.</span> @enderror
                              </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label"> Local destino </label>
                              <input class="form-control" type="text" name="local_destino" min="1" value="{{$rpiquete->local_destino}}" placeholder="local destino" style="background-color: #E9ECEF;  color: #000000" disabled>
                              @error('local_destino') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Data e Hora de Partida </label>
                                <input class="form-control" type="datetime-local" name="data_partida" value="{{$rpiquete->data_partida}}" style="background-color: #E9ECEF;  color: #000000" disabled>
                                @error('data_partida') <span style="color: red">{{$message}}.</span> @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Data e Hora de Chegada </label>
                                <input class="form-control" type="datetime-local" name="data_chegada" value="{{$rpiquete->data_chegada}}" style="background-color: #E9ECEF;  color: #000000" disabled>
                                @error('data_chegada') <span style="color: red">{{$message}}.</span> @enderror
                            </div>

                              <div class="mb-3 col-md-4">
                                <label class="col-form-label">Número de Passageiro</label>
                                <input class="form-control" type="number" name="numero_passageiro" min="1" value="{{$rpiquete->numero_passageiro}}" placeholder="Numero passageiro" style="background-color: #E9ECEF;  color: #000000" disabled>
                                @error('numero_passageiro') <span style="color: red">{{$message}}.</span> @enderror
                              </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label">Especificação da Viatura</label>
                              <textarea class="form-control" name="espe_viatura" placeholder="Especificação da Viatura" rows="1" cols="50" style="background-color: #E9ECEF, color: #000000" >{{$rpiquete->espe_viatura}}</textarea>
                              @error('espe_viatura') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Killometragem Prevista</label>
                                <div class="input-group">
                                    <input class="form-control"  type="number" name="km_prevista" min="0" value="{{$rpiquete->km_prevista}}" placeholder="Km" style="background-color: #E9ECEF" >
                                    <div class="input-group-append">
                                        <span class="input-group-text">km</span>
                                    </div>
                                </div>
                                @error('km_prevista') <span style="color: red">{{$message}}.</span> @enderror
                            </div>

                           
                        </div>

                </div>
                <div class="card-footer">
                    <a href="{{ route('rpiquete.list') }}" class="btn btn-danger">Cancelar</a>
                    <a href="{{ route('rpiquete.list') }}" type="submit" class="btn btn-success"  >Salvar</a>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>

@endsection
