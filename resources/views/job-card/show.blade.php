@extends('layouts.simple.master')
@section('title', 'Job Card')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Job Card</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Job Card</li>
    <li class="breadcrumb-item active">Detalhes</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Detalhes</h5>
                    {{-- <span> campo obrigatório</span> --}}
                </div>
                <div class="card-body">
                    <h6>Detalhes do job card</h6>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="col-form-label">Viatura</label>
                            <input class="form-control digits" type="text" value="{{ ($job->viatura_1) ? $job->viatura_1 : $job->viatura_2 }}" readonly>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <label for="descricao">Descrição do diagnóstico da avaria</label>
                                <textarea class="form-control" rows="5" readonly>{{$job->descricao_diagnostico}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <label for="descricao">Causa da avaria</label>
                                <textarea class="form-control" rows="5" readonly>{{$job->causa_avaria}}</textarea>
                            </div>
                        </div>
                    </div>
                    @if ($trabalhos)
                        <hr>
                        <h6>Trabalhos Efectuados</h6>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Descrição</th>
                                            <th colspan="3" style="text-align: center">Técnico (1)</th>
                                            <th colspan="3" style="text-align: center">Técnico (2)</th>
                                        </tr>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Início</th>
                                            <th>Fim</th>
                                            <th>Nome</th>
                                            <th>Início</th>
                                            <th>Fim</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trabalhos as $key => $trabalho)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$trabalho->descricao_trabalho}}</td>
                                                <td>{{$trabalho->tecnico_nome_1 . ' ' . $trabalho->tecnico_apelido_1}}</td>
                                                <td>{{date('d-m-Y, H:i', strtotime($trabalho->data_hora_inicio_1))}}</td>
                                                <td>{{date('d-m-Y, H:i', strtotime($trabalho->data_hora_fim_1))}}</td>
                                                <td>{{($trabalho->tecnico_nome_2) ? $trabalho->tecnico_nome_2 . ' ' . $trabalho->tecnico_apelido_2 : '-'}}</td>
                                                <td>{{($trabalho->data_hora_inicio_2) ? date('d-m-Y, H:i', strtotime($trabalho->data_hora_inicio_2)) : '-'}}</td>
                                                <td>{{($trabalho->data_hora_fim_2) ? date('d-m-Y, H:i', strtotime($trabalho->data_hora_fim_2)) : '-'}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                 <div class="card-footer">
                    <a href="{{ route('job-card.list') }}" class="btn btn-danger">Voltar</a>
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
