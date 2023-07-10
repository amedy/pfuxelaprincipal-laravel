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
<li class="breadcrumb-item active">Responder</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Responder</h5>
               {{-- <span> <span style="color: red">*</span> campo obrigatório</span> --}}
            </div>
            <form class="theme-form mega-form" action="{{ route('requisicao.send', Crypt::encrypt($requisicao->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h6>Informação do cliente</h6>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label class="col-form-label">Nome</label>
                            <input class="form-control" type="text" value="{{$requisicao->nome}}" placeholder="-" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="col-form-label">E-mail</label>
                            <input class="form-control" type="text" value="{{$requisicao->email}}" placeholder="-" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="col-form-label">Contacto</label>
                            <input class="form-control" type="text" value="{{$requisicao->contacto}}" placeholder="-" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="col-form-label">Contacto Alternativo</label>
                            <input class="form-control" type="text" value="{{$requisicao->contacto_alt}}" placeholder="-" disabled>
                        </div>
                    </div>
                    <hr class="mt-4 mb-4">
                    <h6>Responder a requisição</h6>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="col-form-label">Mensagem <span style="color: red">*</span></label>
                            <textarea class="form-control" name="mensagem" rows="8"></textarea>
                            @error('mensagem') <span style="color: red">{{$message}}.</span> @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="col-form-label">Anexos</label>
                            <input class="form-control" type="file" name="anexos[]" multiple>
                            @error('anexos') <span style="color: red">{{$message}}.</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('requisicao.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Enviar</button>
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
