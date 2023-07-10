@extends('layouts.simple.master')
@section('title', 'Utilizador')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Utilizador</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Utilizador</li>
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
                                <th>Nome de utilizador</th>
                                <th>E-mail</th>
                                <th>Grupo de acesso</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utilizadores as $utilizador)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$utilizador->name}}</td>
                                    <td>{{$utilizador->email}}</td>
                                    <td>{{$utilizador->role_nome}}</td>
                                    <td>
                                        <a href="#" class="h5 p-r-5" data-bs-toggle="modal" data-bs-target="#details_modal_{{$utilizador->id}}"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        @if ($utilizador->id != Auth::user()->id) @if (Arr::has($permissions, 'utilizador.update'))  <a href="{{ route('utilizador.update', Crypt::encrypt($utilizador->id)) }}" class="h5"> <i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a> @endif
                                        @if (Arr::has($permissions, 'utilizador.state')) <a href="{{ route('utilizador.state', [Crypt::encrypt($utilizador->id), (($utilizador->active == 1) ? Crypt::encrypt(0) : Crypt::encrypt(1))]) }}" class="h5 p-l-5"> <i class="fa fa-{{($utilizador->active == 1) ? 'stop' : 'play-circle'}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{($utilizador->active == 1) ? 'Desactivar' : 'Activar'}}"></i></a> @endif
                                        @if (Arr::has($permissions, 'utilizador.delete')) <a href="#" class="h5 p-l-5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$utilizador->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="details_modal_{{$utilizador->id}}" tabindex="-1" role="dialog" aria-labelledby="Detalhes" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalhes</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Informação do utilizador</h6>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Nome de utilizador</label>
                                                            <input class="form-control" type="text" value="{{$utilizador->name}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">E-mail</label>
                                                            <input class="form-control" type="text" value="{{$utilizador->email}}" placeholder="-" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Grupo de acesso</label>
                                                            <input class="form-control" type="text" value="{{$utilizador->role_nome}}" placeholder="-" readonly>
                                                        </div>
                                                    </div>
                                                    @if ($utilizador->pessoa_id)
                                                    <hr class="mt-4 mb-4">
                                                    <h6>Informação do perfil</h6>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Nome <span style="color: red">*</span></label>
                                                                <input class="form-control" type="text" value="{{ $utilizador->pessoa_nome }}" placeholder="-" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Apelido <span style="color: red">*</span></label>
                                                                <input class="form-control" type="text" value="{{ $utilizador->pessoa_apelido }}" placeholder="-" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Data de Nascimento <span style="color: red">*</span></label>
                                                                <div class="input-group">
                                                                    <input class="form-control digits" type="date" max="{{date('Y-m-d')}}" value="{{ $utilizador->pessoa_data_nascimento }}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Gênero <span style="color: red">*</span></label>
                                                                <input class="form-control" type="text" value="{{$utilizador->genero_nome}}" placeholder="-" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Estado Civil</label>
                                                                <input class="form-control" type="text" value="{{$utilizador->estado_civil_nome}}" placeholder="-" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Tipo de doc. de identificação <span style="color: red">*</span></label>
                                                                <input class="form-control" type="text" value="{{$utilizador->tipo_documento_nome}}" placeholder="-" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Nº do doc. de identif. <span style="color: red">*</span></label>
                                                                <input class="form-control" type="text" value="{{$utilizador->pessoa_numero_documento}}" placeholder="-" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Contacto <span style="color: red">*</span></label>
                                                                <input class="form-control" type="text" value="{{$utilizador->pessoa_contacto}}" placeholder="-" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Contacto Alternativo</label>
                                                                <input class="form-control" type="text" value="{{$utilizador->pessoa_contacto_alt}}" placeholder="-" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Nuit</label>
                                                                <input class="form-control" type="text" value="{{$utilizador->pessoa_nuit}}" placeholder="-" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Inss</label>
                                                                <input class="form-control" type="text" value="{{$utilizador->pessoa_inss}}" placeholder="-" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="col-form-label">Morada</label>
                                                                <input class="form-control" type="text" value="{{$utilizador->pessoa_morada}}" placeholder="-" readonly>
                                                            </div>
                                                        </div>
                                                    @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete_modal_{{$utilizador->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('utilizador.delete',[ Crypt::encrypt($utilizador->id), Crypt::encrypt($utilizador->user_role_id)]) }}" method="POST">
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
