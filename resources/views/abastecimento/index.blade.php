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
                                <th>Bombas</th>
                                <th>Quantidade total (litros)</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ordens as $ordem)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$ordem->codigo}}</td>
                                    <td>{{$ordem->nome}}</td>
                                    <td>{{number_format($ordem->combustivel_total, 2, '.')}} l</td>
                                    <td>{{$ordem->tipo}}</td>
                                    <td><span class="badge @if($ordem->estado == 'Aberta' || $ordem->estado == 'Pendente')badge-warning @elseif($ordem->estado == 'Cancelada')badge-danger @else badge-success @endif">{{ $ordem->estado }}</span></td>
                                    <td>
                                        <a href="{{ route('abastecimento.show', Crypt::encrypt($ordem->id)) }}" class="h5 p-r-5"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        @if ($ordem->estado == 'Aberta' && Arr::has($permissions, 'abastecimento.retrieve')) <a href="{{ route('abastecimento.retrieve', Crypt::encrypt($ordem->id)) }}" class="h5"> <i class="fa fa-exchange" data-bs-toggle="tooltip" data-bs-placement="top" title="Terminar ordem"></i></a> @endif
                                        @if ($ordem->estado == 'Pendente' && Arr::has($permissions, 'abastecimento.approve')) <a href="#" class="h5 txt-success" data-bs-toggle="modal" data-bs-target="#approve_modal_{{$ordem->id}}"> <i class="fa fa-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Autorizar"></i></a> @endif
                                        @if (($ordem->estado == 'Autorizada' || $ordem->estado == 'Pendente') && Arr::has($permissions, 'abastecimento.cancel')) <a href="#" class="h5 txt-danger" data-bs-toggle="modal" data-bs-target="#cancel_modal_{{$ordem->id}}"> <i class="fa fa-times-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"></i></a> @endif
                                        @if (Arr::has($permissions, 'abastecimento.delete')) <a href="#" class="h5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$ordem->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="delete_modal_{{$ordem->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('abastecimento.delete', Crypt::encrypt($ordem->id)) }}" method="POST">
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
