@extends('layouts.simple.master')
@section('title', 'Utilizador')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Utilizador</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Utilizador</li>
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
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('utilizador.store') }}" method="POST">
                @csrf
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Nome de utilizador <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="nome" value="{{old('nome')}}" placeholder="Digite o nome do utilizador">
                                @error('nome') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">E-mail <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="email" value="{{old('email')}}" placeholder="Digite o email">
                                @error('email') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                               <label class="col-form-label">Grupo de permissões <span style="color: red">*</span></label>
                                  <select class="js-example-basic-single col-sm-12" name="grupo_de_permissoes">
                                     <option value="">Escolha uma opcção</option>
                                     @foreach ($grupos as $grupo)
                                        <option value="{{$grupo->id}}" {{(old('grupo_de_permissoes') == $grupo->id) ? 'selected' : ''}}>{{$grupo->nome}}</option>
                                     @endforeach
                               </select>
                               @error('grupo_de_permissoes') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Senha <span style="color: red">*</span></label>
                                <input class="form-control" type="password" name="senha" value="" placeholder="Digite a senha">
                                @error('senha') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Confirmação da Senha <span style="color: red">*</span></label>
                                <input class="form-control" type="password" name="senha_confirmation" value="" placeholder="Confirme a senha">
                                @error('senha_confirmation') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('utilizador.list') }}" class="btn btn-danger">Cancelar</a>
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
