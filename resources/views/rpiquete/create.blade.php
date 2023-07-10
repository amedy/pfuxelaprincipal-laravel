@extends('layouts.simple.master')
@section('title', 'Piquete')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Plano </h3>
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
               <h5>Create piquete Plano</h5>
               <span> <span style="color: red">*</span> Required field</span>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('rpiquete.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                        <div class="row">
                      <div class="mb-3 col-md-4">
                              <label class="col-form-label">Motorista <span style="color: red">*</span></label>
                              <select class="js-example-basic-single col-sm-12" name="motorista">
                                 <option value="">Escolha um Motorista</option>
                                 @foreach ($motoristas as $motorista)
                                    <option value="{{$motorista->nome}}">{{$motorista->nome}}</option>
                                 @endforeach  
</select>
                              @error('motorista') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <!-- select name_cliente -->
                           <div class="mb-3 col-md-4">
                              <label class="col-form-label">Name cliente <span style="color: red">*</span></label>
                              <select class="js-example-basic-single col-sm-12" name="cliente">
                                 <option value="">Escolha um cliente</option>
                                 @foreach ($name_clientes as $name_cliente)
                                    <option value="{{$name_cliente->nome}}">{{$name_cliente->nome}}</option>
                                 @endforeach  
                              </select>
                             
                              @error('cliente') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <!-- endSelect clinet -->
                            <!-- <div class="mb-3 col-md-4">
                                <label class="col-form-label">Name name_cliente <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="name_name_cliente" value="{{old('name_name_cliente')}}" placeholder="enter customer name_name_cliente">
                                @error('name_name_cliente') <span style="color: red">{{$message}}.</span> @enderror
                            </div> -->
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label"> Local origem <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="local_origem" min="1" value="{{old('local_origem')}}" placeholder="local origem">
                                @error('local_origem') <span style="color: red">{{$message}}.</span> @enderror
                              </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label"> Local destino <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="local_destino" min="1" value="{{old('local_destino')}}" placeholder="local destino">
                              @error('local_destino') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Data e Hora de Partida <span style="color: red">*</span></label>
                                <input class="form-control" type="datetime-local" name="data_partida" value="{{old('data_partida')}}" >
                                @error('data_partida') <span style="color: red">{{$message}}.</span> @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Data e Hora de Chegada <span style="color: red">*</span></label>
                                <input class="form-control" type="datetime-local" name="data_chegada" value="{{old('data_chegada')}}" >
                                @error('data_chegada') <span style="color: red">{{$message}}.</span> @enderror
                            </div>

                              <div class="mb-3 col-md-4">
                                <label class="col-form-label">Numero de Passageiro<span style="color: red">*</span></label>
                                <input class="form-control" type="number" name="numero_passageiro" min="1" value="{{old('numero_passageiro')}}" placeholder="Numero passageiro">
                                @error('numero_passageiro') <span style="color: red">{{$message}}.</span> @enderror
                              </div>
                           
                            <!-- <div class="mb-3 col-md-4">
                              <label  class="col-form-label">Especificação da Viatura</label>
                              <textarea  class="form-control" name="espe_viatura" placeholder="Especificação da Viatura" rows="1" cols="50">{{old('espe_viatura')}}</textarea>
                              @error('espe_viatura') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label   class="col-form-label">Kilometragem Prevista</label>
                                <div class="input-group">
                                    <input  class="form-control" type="number" name="km_prevista" min="0" value="{{old('km_prevista')}}" placeholder="Km">
                                    <div class="input-group-append">
                                        <span class="input-group-text">km</span>
                                    </div>
                                </div>
                                @error('km_prevista') <span style="color: red">{{$message}}.</span> @enderror
                            </div> -->
   <div class="mb-3 col-md-4">
                                <label class="col-form-label">Anexar Plano de Viagem</label>
                                <input class="form-control" type="file" name="file" multiple require>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label hidden class="col-form-label">Alocar Viatura<span style="color: red">*</span></label>
                                <input hidden class="form-control" type="text" name="alocar_viatura" min="1" value="0" placeholder="Alocar Viatura">
                                @error('alocar_viatura') <span style="color: red">{{$message}}.</span> @enderror
                              </div>
                              <div class="mb-3 col-md-4">
                                <label hidden class="col-form-label">Quantidade de Combustivel </label>
                                <input hidden class="form-control" type="number" name="qtd_combustivel" min="0" value="0" placeholder="Digite a quantidade Combustivel">
                                @error('qtd_combustivel') <span style="color: red">{{$message}}.</span> @enderror
                              </div>
                              <!-- <div class="mb-3 col-md-3">
                                <label hidden class="col-form-label">Rotas <span style="color: red">*</span></label>
                               <select hidden class="hidden" name="rota[]" multiple="multiple">
                                    @foreach ($rotas as $rota)
                                        <option hidden value="0">{{$rota->id}}</option>
                                    @endforeach
                                </select>
                                @error('rota') <span style="color: red">{{$message}}.</span> @enderror
                            </div> -->
                            

                        </div>

                </div>
                <div class="card-footer">
                    <a href="{{ route('/') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Salvar</button>
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
