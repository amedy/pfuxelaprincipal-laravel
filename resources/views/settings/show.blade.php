@extends('layouts.simple.master')
@section('title', 'Definições')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Definições</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Definições</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <h5>Aparência</h5>
            <span>Configure as definições da aparência do sistema</span>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <form action="{{ route('definicoes.appearance.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4 media">
                                <label class="col-form-label">Modo Escuro</label>
                                <div class="media-body text-end icon-state switch-outline">
                                    <label class="switch">
                                    <input type="checkbox" name="dark_mode" {{ ($user->dark_mode == 1) ? 'checked' : ''}}><span class="switch-state bg-primary"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($user->nome == 'Administradores')
        <div class="row">
            <div class="col-md-3">
                <h5>Funcionamento</h5>
                <span>Configure as definições de funcionamento do sistema</span>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <form action="{{ route('definicoes.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Preço de Gasolina <span style="color: red">*</span></label>
                                <input class="form-control" type="number" step="0.01" min="1" name="preco_gasolina" value="{{ $gasolina->preco }}" placeholder="Digite o preço de gasolina">
                                @error('preco_gasolina') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Preço de Diesel <span style="color: red">*</span></label>
                                <input class="form-control" type="number" step="0.01" min="1" name="preco_diesel" value="{{ $diesel->preco }}" placeholder="Digite preço de diesel">
                                @error('preco_diesel') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('script')
@endsection
