@extends('layouts.simple.master')
@section('title', 'Job Card')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Job Card</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Job Card</li>
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
                <form class="theme-form mega-form" autocomplete="off" action="{{ route('job-card.store', ($ocorrencia) ? Crypt::encrypt($ocorrencia->id) : null) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if ($ocorrencia)
                            <h6>Ocorrência</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 mb-0">
                                        <label for="descricao">Descrição do motorista</label>
                                        <textarea class="form-control" rows="4" disabled>{{$ocorrencia->descricao_motorista}}</textarea>
                                    </div>
                                    <div class="mb-3 mb-0">
                                        <label for="descricao">Descrição da inspecção</label>
                                        <textarea class="form-control" rows="4" disabled>{{$ocorrencia->descricao_inspeccao}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h6>Job Card</h6>
                        @endif
                            <div class="row">
                                @if (!$ocorrencia)
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Viatura <span style="color: red">*</span></label>
                                        <select class="js-example-basic-single col-sm-12" name="viatura">
                                            <option value="">Escolha uma opcção</option>
                                            @foreach ($viaturas as $viatura)
                                                <option value="{{$viatura->id}}" {{(old('viatura') == $viatura->id) ? 'selected' : ''}}>{{$viatura->matricula}}</option>
                                            @endforeach
                                        </select>
                                        @error('viatura') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="mb-3 mb-0">
                                        <label for="descricao">Descrição do diagnóstico da avaria <span style="color: red">*</span></label>
                                        <textarea class="form-control" name="descricao_diagnostico" rows="5">{{old('descricao_diagnostico')}}</textarea>
                                    </div>
                                    @error('descricao_diagnostico') <span style="color: red">{{$message}}.</span> @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 mb-0">
                                        <label for="descricao">Causa da avaria <span style="color: red">*</span></label>
                                        <textarea class="form-control" name="causa_avaria" rows="5">{{old('causa_avaria')}}</textarea>
                                    </div>
                                    @error('causa_avaria') <span style="color: red">{{$message}}.</span> @enderror
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <a href="@if ($ocorrencia) {{ route('ocorrencia.list') }} @else {{ route('job-card.list') }} @endif" class="btn btn-danger">Cancelar</a>
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
