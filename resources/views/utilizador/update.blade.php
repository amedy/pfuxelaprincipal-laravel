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
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('utilizador.put', [Crypt::encrypt($utilizador->id), Crypt::encrypt($utilizador->user_role_id)]) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="col-form-label">Nome <span style="color: red">*</span></label>
                            <input class="form-control" type="text" name="nome" value="{{$utilizador->name}}" placeholder="Digite o nome do utilizador">
                            @error('nome') <span style="color: red">{{$message}}.</span> @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="col-form-label">E-mail <span style="color: red">*</span></label>
                            <input class="form-control" type="text" name="email" value="{{$utilizador->email}}" placeholder="Digite o email">
                            @error('email') <span style="color: red">{{$message}}.</span> @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                           <label class="col-form-label">Grupo de permissões <span style="color: red">*</span></label>
                              <select class="js-example-basic-single col-sm-12" name="grupo_de_permissoes">
                                 <option value="">Escolha uma opcção</option>
                                 @foreach ($grupos as $grupo)
                                    <option value="{{$grupo->id}}" {{($utilizador->role_id == $grupo->id) ? 'selected' : ''}}>{{$grupo->nome}}</option>
                                 @endforeach
                           </select>
                           @error('grupo_de_permissoes') <span style="color: red">{{$message}}.</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('utilizador.list') }}" class="btn btn-danger">Cancelar</a>
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
