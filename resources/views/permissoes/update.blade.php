@extends('layouts.simple.master')
@section('title', 'Permissões')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Permissões</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Permissões</li>
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
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('permissoes.put', Crypt::encrypt($grupo->id)) }}" method="POST">
                @csrf
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Nome do grupo de permissões <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="nome_do_grupo" value="{{ $grupo->nome }}" placeholder="Digite o nome do grupo de permissões">
                                @error('nome_do_grupo') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                           <div class="col">
                              <div class="mb-3 mb-0">
                                 <label for="descricao">Descrição</label>
                                 <textarea class="form-control" name="descricao" rows="3">{{ $grupo->descricao }}</textarea>
                              </div>
                              @error('descricao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('permissoes.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">salvar</button>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection
