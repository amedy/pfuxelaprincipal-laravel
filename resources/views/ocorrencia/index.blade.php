@extends('layouts.simple.master')
@section('title', 'Ocorrência')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Ocorrência</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Ocorrência</li>
<li class="breadcrumb-item active">Lista</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Lista</h5>
               {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>viatura</th>
                                <th>Motorista</th>
                                <th>Tipo</th>
                                <th>Data e Hora</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ocorrencias as $ocorrencia)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$ocorrencia->viatura}}</td>
                                    <td>{{$ocorrencia->motorista_nome .' '. $ocorrencia->motorista_apelido}}</td>
                                    <td>{{$ocorrencia->tipo}}</td>
                                    <td>{{date('d-m-Y, H:i', strtotime($ocorrencia->data_hora))}}</td>
                                    <td>
                                        <a href="#" class="h5 p-r-5" data-bs-toggle="modal" data-bs-target="#details_modal_{{$ocorrencia->id}}"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        @if (Arr::has($permissions, 'ocorrencia.update')) <a href="{{ route('ocorrencia.update', Crypt::encrypt($ocorrencia->id)) }}" class="h5"> <i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a> @endif
                                        @if($ocorrencia->tipo == 'Acção Necessária' && Arr::has($permissions, 'ocorrencia.job-card')) <a href="{{ route('ocorrencia.job-card', Crypt::encrypt($ocorrencia->id)) }}" class="h5"> <i class="fa fa-book" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir job card"></i></a> @endif
                                        @if (Arr::has($permissions, 'ocorrencia.delete')) <a href="#" class="h5 p-l-5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$ocorrencia->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="details_modal_{{$ocorrencia->id}}" tabindex="-1" role="dialog" aria-labelledby="Detalhes" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalhes</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                           <div class="mb-3 mb-0">
                                                              <label for="descricao">Descrição do motorista </label>
                                                              <textarea class="form-control" name="descricao" rows="5" disabled>{{$ocorrencia->descricao_motorista}}</textarea>
                                                           </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                           <div class="mb-3 mb-0">
                                                              <label for="descricao">Descrição da inspecção </label>
                                                              <textarea class="form-control" name="descricao" rows="5" disabled>{{$ocorrencia->descricao_inspeccao}}</textarea>
                                                           </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Tipo de ocorrência </label>
                                                            <input class="form-control" type="text" value="{{$ocorrencia->tipo}}" placeholder="-" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                           <label class="col-form-label">Data e hora da ocorrência </label>
                                                           <input class="form-control" type="text" value="{{date('d-m-Y, H:i', strtotime($ocorrencia->data_hora))}}" placeholder="-" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Motorista </label>
                                                            <input class="form-control" type="text" value="{{$ocorrencia->motorista_nome .' '. $ocorrencia->motorista_apelido}}" placeholder="-" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Viatura </label>
                                                            <input class="form-control" type="text" value="{{$ocorrencia->viatura}}" placeholder="-" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Kilometragem (km)</label>
                                                            <input class="form-control" type="text" value="{{number_format($ocorrencia->odometro)}}" placeholder="-" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete_modal_{{$ocorrencia->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('ocorrencia.delete', Crypt::encrypt($ocorrencia->id)) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminar</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div style="text-align: center">
                                                        <i class="fa fa-warning txt-danger h2"></i>
                                                        <h5>Tem a certeza?</h5>
                                                        <h5>Se continuar não poderá reverter esta acção!</h5>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="justify-content: center">
                                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancelar</button>
                                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
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
