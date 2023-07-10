@extends('layouts.simple.master')
@section('title', 'Bombas')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Bombas</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Bombas</li>
    <li class="breadcrumb-item active">Criar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Criar</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('bombas.store') }}" method="POST">
                @csrf
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Nome <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="nome" value="{{old('nome')}}" placeholder="Digite o nome das bombas">
                                @error('nome') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Tipo <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="tipo">
                                    <option value="">Escolha uma opcção</option>
                                    <option value="Interna">Interna</option>
                                    <option value="Externa">Externa</option>
                                </select>
                                @error('genero') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label">Capacidade das bombas (l)</label>
                              <input class="form-control" type="number" name="capacidade_das_bombas" min="1" value="{{old('capacidade_das_bombas')}}" placeholder="Digite a capacidade das bombas">
                              @error('capacidade_das_bombas') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label">Quantidade mínima (l) <i class="fa fa-question-circle font-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Esta é a quantidade mínima de combustível para efeitos de controle de stock!"></i> </label>
                              <input class="form-control" type="number" name="quantidade_minima" min="1" value="{{old('qtd_minima')}}" placeholder="Digite a quantidade mínima">
                              @error('qtd_minima') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label">Quantidade disponível (l) </label>
                              <input class="form-control" type="number" name="quantidade_disponivel" min="0" value="{{old('qtd_disponivel')}}" placeholder="Digite a quantidade disponível">
                              @error('qtd_disponivel') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('bombas.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Registar</button>
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
