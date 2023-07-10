@extends('layouts.simple.master')
@section('title', 'Peças')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Peças</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Peças</li>
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
                                <th>Código</th>
                                <th>Designação</th>
                                <th>Quantidade actual (unidades)</th>
                                <th>Descrição</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pecas as $peca)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$peca->codigo}}</td>
                                    <td>{{$peca->designacao}}</td>
                                    <td>{{$peca->quantidade_actual}}</td>
                                    <td>{{$peca->descricao}}</td>
                                    <td>
                                        <a href="#" class="h5 p-r-5" data-bs-toggle="modal" data-bs-target="#details_modal_{{$peca->id}}"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        @if (Arr::has($permissions, 'pecas.update')) <a href="{{ route('pecas.update', Crypt::encrypt($peca->id)) }}" class="h5"> <i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a> @endif
                                        @if (Arr::has($permissions, 'pecas.delete')) <a href="#" class="h5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$peca->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="details_modal_{{$peca->id}}" tabindex="-1" role="dialog" aria-labelledby="Detalhes" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalhes</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
                                                        <label class="col-form-label">Designação</label>
                                                        <input class="form-control" type="text" value="{{ $peca->designacao }}" placeholder="-" readonly>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="col-form-label">Custo da peça (Meticais)</label>
                                                        <input class="form-control" type="number" value="{{ $peca->valor }}" placeholder="-" readonly>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="col-form-label">Quantidade actual (unidades)</label>
                                                        <input class="form-control" type="number" value="{{ $peca->quantidade_actual }}" placeholder="-" readonly>
                                                    </div>
                                                    <div class="col-md-12">
                                                       <div class="mb-3 mb-0">
                                                          <label for="descricao">Descrição</label>
                                                          <textarea class="form-control" placeholder="-" rows="5" readonly>{{ $peca->descricao }}</textarea>
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
                                <div class="modal fade" id="delete_modal_{{$peca->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('pecas.delete', Crypt::encrypt($peca->id)) }}" method="POST">
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
