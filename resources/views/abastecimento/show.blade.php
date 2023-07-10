@extends('layouts.simple.master')
@section('title', 'Abastecimento')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Abastecimento</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Abastecimento</li>
    <li class="breadcrumb-item">Ordem</li>
    <li class="breadcrumb-item active">Detalhes</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row m-b-10">
                        <div class="col-md-10">
                            <a href="{{ route('abastecimento.list') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Voltar"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-pill @if($ordem->estado == 'Aberta' || $ordem->estado == 'Pendente') btn-air-warning badge badge-warning @elseif($ordem->estado == 'Cancelada') btn-air-danger badge badge-danger @else btn-air-success badge badge-success @endif">{{ $ordem->estado }}</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Código</label>
                                <input class="form-control digits" type="text" value="{{ $ordem->codigo }}" readonly>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Bombas</label>
                                <input class="form-control digits" type="text" value="{{ $ordem->bombas }}" readonly>
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Quantidade Total (Litros)</label>
                               <input class="form-control digits" type="text" value="{{ number_format($ordem->combustivel_total, 2, '.') }}" readonly>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Tipo</label>
                                <input class="form-control digits" type="text" value="{{ $ordem->tipo }}" readonly>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Objectivo</label>
                                <input class="form-control digits" type="text" value="{{ $ordem->objectivo }}" readonly>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Requisitada por</label>
                                <input class="form-control digits" type="text" value="{{ $ordem->created_by }}" readonly>
                            </div>
                            @if ($ordem->estado != 'Pendente')
                                <div class="mb-3 col-md-3">
                                    <label class="col-form-label">{{ $ordem->estado }} por</label>
                                    <input class="form-control digits" type="text" value="{{ $ordem->action_by }}" placeholder="-" readonly>
                                </div>
                            @endif
                        </div>
                </div>
                <div class="card-footer">
                    @if (($ordem->estado == 'Autorizada' || $ordem->estado == 'Pendente') && Arr::has($permissions, 'abastecimento.cancel')) <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancel_modal_{{$ordem->id}}"> <i class="fa fa-times-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"></i> Cancelar</a> @endif
                    @if ($ordem->estado == 'Pendente' && Arr::has($permissions, 'abastecimento.approve')) <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve_modal_{{$ordem->id}}"> <i class="fa fa-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Autorizar"></i> Autorizar</a> @endif

                    <div class="modal fade" id="approve_modal_{{$ordem->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('abastecimento.approve', Crypt::encrypt($ordem->id)) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Autorizar ordem</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div style="text-align: center">
                                            <i class="fa fa-warning txt-danger h2"></i>
                                            <h5>Tem a certeza que quer autorizar esta ordem de abastecimento?</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="justify-content: center">
                                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Voltar</button>
                                        <button class="btn btn-success" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="cancel_modal_{{$ordem->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('abastecimento.cancel', Crypt::encrypt($ordem->id)) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cancelar ordem</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div style="text-align: center">
                                            <i class="fa fa-warning txt-danger h2"></i>
                                            <h5>Tem a certeza que quer cancelar esta ordem de abastecimento?</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="justify-content: center">
                                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Voltar</button>
                                        <button class="btn btn-success" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6>Lista das ordens</h6>
                    <hr>
                        <div class="row" id="fuel_table">
                            <div class="table-responsive">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Matrícula</th>
                                            <th>Quantidade (Litros)</th>
                                            <th>Total (Meticais)</th>
                                            <th>Rotas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viaturas as $viatura)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$viatura->matricula}}</td>
                                                <td>{{number_format($viatura->combustivel_abastecer, 2, '.')}} l</td>
                                                <td>{{number_format($viatura->preco_total, 2, '.')}} Mts</td>
                                                <td>
                                                    @foreach ($rotas_ordem as $rota)
                                                        @foreach ($rotas as $route)
                                                            @if ($rota->rota_id == $route->id && $rota->ordem_viatura_id == $viatura->id)
                                                                <span class="badge badge-success"> {{ $route->name }} </span>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
