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
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Editar</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('bombas.put', Crypt::encrypt($bomba->id)) }}" method="POST">
                @csrf
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Nome <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="nome" value="{{ $bomba->nome }}" placeholder="Digite o nome das bombas">
                                @error('nome') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Tipo <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="tipo">
                                    <option value="">Escolha uma opcção</option>
                                    <option value="Interna" {{ ($bomba->tipo == 'Interna') ? 'selected' : '' }}>Interna</option>
                                    <option value="Externa" {{ ($bomba->tipo == 'Externa') ? 'selected' : '' }}>Externa</option>
                                </select>
                                @error('genero') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label">Capacidade das bombas (l) <span style="color: red">*</span></label>
                              <input class="form-control" type="number" name="capacidade_das_bombas" min="1" value="{{ $bomba->capacidade }}" placeholder="Digite a capacidade das bombas">
                              @error('capacidade_das_bombas') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label">Quantidade mínima (l) <i class="fa fa-question-circle font-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Esta é a quantidade mínima de combustível para efeitos de controle de stock!"></i> </label>
                              <input class="form-control" type="number" name="quantidade_minima" min="1" value="{{ $bomba->minima }}" placeholder="Digite a quantidade mínima">
                              @error('quantidade_minima') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('bombas.list') }}" class="btn btn-danger">Cancelar</a>
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
