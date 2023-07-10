@extends('layouts.simple.master')
@section('title', 'Motorista')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Motorista</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Motorista</li>
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
                                <th>Carta de Condução Nº</th>
                                <th>Nome completo</th>
                                <th>Contacto</th>
                                <th>Contacto Alternativo</th>
                                <th>Estado da carta</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($motoristas as $motorista)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$motorista->numero}}</td>
                                    <td>{{$motorista->nome . ' ' . $motorista->apelido}}</td>
                                    <td>{{$motorista->contacto}}</td>
                                    <td>{{$motorista->contacto_alt}}</td>
                                    <td><span class="badge badge-{{($motorista->data_validade > date('Y-m-d')) ? 'success' : 'danger'}}">{{($motorista->data_validade > date('Y-m-d')) ? 'Válida' : 'Inválida'}}</span></td>
                                    <td>
                                        <a href="#" class="h5 p-r-5" data-bs-toggle="modal" data-bs-target="#details_modal_{{$motorista->id}}"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        @if (Arr::has($permissions, 'motorista.update')) <a href="{{ route('motorista.update', Crypt::encrypt($motorista->id)) }}" class="h5"> <i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a> @endif
                                        @if (Arr::has($permissions, 'motorista.docs.update')) <a href="{{ route('motorista.docs.update', Crypt::encrypt($motorista->id)) }}" class="h5 p-l-5 p-r-5"> <i class="fa fa-book" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar carta de condução"></i></a> @endif
                                        @if (Arr::has($permissions, 'motorista.delete')) <a href="#" class="h5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$motorista->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="details_modal_{{$motorista->id}}" tabindex="-1" role="dialog" aria-labelledby="Detalhes" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalhes</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Informação básica</h6>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Nome</label>
                                                            <input class="form-control" type="text" value="{{$motorista->nome}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Apelido</label>
                                                            <input class="form-control" type="text" value="{{$motorista->apelido}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Data de Nascimento</label>
                                                            <input class="form-control" type="text" value="{{date('d-F-Y', strtotime($motorista->data_nascimento))}}" placeholder="-" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Gênero</label>
                                                            <input class="form-control" type="text" value="{{$motorista->genero}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Estado Civil</label>
                                                            <input class="form-control" type="text" value="{{$motorista->genero}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Tipo de doc. de identificação</label>
                                                            <input class="form-control" type="text" value="{{$motorista->tipo_documento}}" placeholder="-" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Número do doc. de identificação</label>
                                                            <input class="form-control" type="text" value="{{$motorista->numero_documento}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Contacto</label>
                                                            <input class="form-control" type="text" value="{{$motorista->contacto}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Contacto Alternativo</label>
                                                            <input class="form-control" type="text" value="{{$motorista->contacto_alt}}" placeholder="-" readonly>
                                                        </div>
                                                    </div>
                                                <hr class="mt-4 mb-4">
                                                <h6>Outras Informações</h6>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Carta de condução Nº</label>
                                                            <input class="form-control" type="text" value="{{$motorista->numero}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Data de Emissão</label>
                                                            <input class="form-control" type="text" value="{{date('d-F-Y', strtotime($motorista->data_emissao))}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Data de Validade</label>
                                                            <input class="form-control" type="text" value="{{date('d-F-Y', strtotime($motorista->data_validade))}}" placeholder="-" readonly>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete_modal_{{$motorista->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('motorista.delete', Crypt::encrypt($motorista->id)) }}" method="POST">
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
