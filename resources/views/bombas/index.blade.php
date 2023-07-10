@extends('layouts.simple.master')
@section('title', 'Bombas')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Bombas</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Bombas</li>
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
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Qtd. disponivel (l)</th>
                                <th>Estoque</th>
                                <th>Estado</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bombas as $bomba)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$bomba->nome}}</td>
                                    <td>{{$bomba->tipo}}</td>
                                    <td>{{$bomba->disponivel}}</td>
                                    <td><span class="badge  @if($bomba->disponivel && $bomba->minima ) @if($bomba->disponivel <= $bomba->minima) badge-warning @elseif($bomba->disponivel == 0) badge-danger @else badge-success @endif @else badge-danger @endif">@if($bomba->disponivel && $bomba->minima) @if($bomba->disponivel <= $bomba->minima) Baixo @elseif($bomba->disponivel == 0) Fora do estoque @else Normal @endif  @else N/D @endif</span></td>
                                    <td><span class="badge badge-{{($bomba->estado == 'Disponível') ? 'success' : 'danger'}}">{{$bomba->estado}}</span></td>
                                    <td>
                                        <a href="#" class="h5 p-r-5" data-bs-toggle="modal" data-bs-target="#details_modal_{{$bomba->id}}"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        @if (Arr::has($permissions, 'bombas.update')) <a href="{{ route('bombas.update', Crypt::encrypt($bomba->id)) }}" class="h5"> <i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a> @endif
                                        @if (Arr::has($permissions, 'bombas.refill') && $bomba->tipo == 'Interna') <a href="{{ route('bombas.refill', Crypt::encrypt($bomba->id)) }}" class="h5"> <i class="fa fa-retweet" data-bs-toggle="tooltip" data-bs-placement="top" title="reabastecer bombas"></i></a> @endif
                                        @if (Arr::has($permissions, 'bombas.state')) <a href="{{ route('bombas.state', [Crypt::encrypt($bomba->id), (($bomba->estado == 'Disponível') ? Crypt::encrypt('Indisponível') : Crypt::encrypt('Disponível'))]) }}" class="h5 p-l-5"> <i class="fa fa-{{($bomba->estado == 'Disponível') ? 'stop' : 'play-circle'}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{($bomba->estado == 'Disponível') ? 'Desactivar' : 'Activar'}}"></i></a> @endif
                                        @if (Arr::has($permissions, 'bombas.delete')) <a href="#" class="h5 p-l-5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$bomba->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="details_modal_{{$bomba->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalhes</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Detalhes das bombas</h6>
                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
                                                        <label class="col-form-label">Nome</label>
                                                        <input class="form-control" type="text" value="{{ $bomba->nome }}" placeholder="-" disabled readonly>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="col-form-label">Tipo</label>
                                                        <input class="form-control" type="text" value="{{ $bomba->tipo }}" placeholder="-" disabled readonly>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                      <label class="col-form-label">Capacidade das bombas (l)</label>
                                                      <input class="form-control" type="number" value="{{ $bomba->capacidade }}" placeholder="-" disabled readonly>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                      <label class="col-form-label">Quantidade disponivel (l) </label>
                                                      <input class="form-control" type="number" value="{{ $bomba->disponivel }}" placeholder="-" disabled readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label><a href="{{ route('bombas.refill.index', Crypt::encrypt($bomba->id)) }}" target="_blank">Reabastecimentos da bombas <i class="fa fa-external-link"></i></a></label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete_modal_{{$bomba->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('bombas.delete', Crypt::encrypt($bomba->id)) }}" method="POST">
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
