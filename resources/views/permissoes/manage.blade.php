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
    <li class="breadcrumb-item active">Gestão</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Gestão</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
               @error('submenus') <span style="color: red">{{$message}}.</span> @enderror
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('permissoes.manage.put', Crypt::encrypt($grupo->id)) }}" method="POST">
                @csrf
                <div class="card-body">
                    <h4>{{ $grupo->nome }}</h4>
                        @foreach ($categories as $category)
                            <hr>
                            <h5>{{ $category->nome }}</h5>
                            <div class="row">
                                @foreach ($items as $item)
                                    @if ($category->id == $item->categoria_id)
                                        <div class="mb-3 col-md-3">
                                            <i class="icofont icofont-{{ $item->icon }}"></i> <label class="col-form-label f-w-900">{{ $item->nome }}</label>
                                            @foreach ($subitems as $subitem)
                                                @if ($item->id == $subitem->menu_id)
                                                    <div class="m-b-5">
                                                        <input class="checkbox_animated" type="checkbox" name="submenus[]" value="{{ $subitem->id }}"@if (count($submenu_roles) > 0) @foreach ($submenu_roles as $submenu_role) {{ (($submenu_role->submenu_id == $subitem->id) ? 'checked' : '') }} @endforeach @endif > {{ $subitem->nome }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                </div>
                <div class="card-footer">
                    <a href="{{ route('permissoes.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection
