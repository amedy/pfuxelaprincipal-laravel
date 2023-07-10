@extends('layouts.simple.master')
@section('title', 'Requisição')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Requisição</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Requisição</li>
<li class="breadcrumb-item active">Detalhes</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Detalhes</h5>
               {{-- <span> <span style="color: red">*</span> campo obrigatório</span> --}}
            </div>
            <div class="card-body">
                <h6>Informação do cliente</h6>
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">Nome</label>
                        <input class="form-control" type="text" value="{{$requisicao->nome}}" placeholder="-" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">E-mail</label>
                        <input class="form-control" type="text" value="{{$requisicao->email}}" placeholder="-" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">Contacto</label>
                        <input class="form-control" type="text" value="{{$requisicao->contacto}}" placeholder="-" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">Contacto Alternativo</label>
                        <input class="form-control" type="text" value="{{$requisicao->contacto_alt}}" placeholder="-" readonly>
                    </div>
                </div>
                <hr class="mt-4 mb-4">
                <h6>Informações da requisição</h6>
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">Data e Hora de partida</label>
                        <input class="form-control" type="text" value="{{date('d-m-Y, H:i ', strtotime($requisicao->data_hora_inicio))}}" placeholder="-" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">Data e Hora de volta</label>
                        <input class="form-control" type="text" value="{{date('d-m-Y, H:i', strtotime($requisicao->data_hora_fim))}}" placeholder="-" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">Local de partida</label>
                        <input class="form-control" type="text" value="{{$requisicao->local_origem}}" placeholder="-" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">Local de destino</label>
                        <input class="form-control" type="text" value="{{$requisicao->local_destino}}" placeholder="-" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="col-form-label">Número de passageiros</label>
                        <input class="form-control" type="text" value="{{$requisicao->numero_passageiros}}" placeholder="-" readonly>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="col-form-label">Descrição</label>
                        <textarea class="form-control" name="descricao" rows="6" readonly>{{$requisicao->descricao}}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('requisicao.list') }}" class="btn btn-danger">Lista</a>
                @if ($requisicao->estado == 'Pendente' && Arr::has($permissions, 'requisicao.answer')) <a href="{{ route('requisicao.answer', Crypt::encrypt($requisicao->id)) }}" class="btn btn-success">Responder</a> @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
