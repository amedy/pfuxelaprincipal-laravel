@extends('layouts.simple.master')
@section('title', 'Requisição')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Requisição</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Requisição</li>
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
                                <th>Nome do Cliente</th>
                                <th>Contacto</th>
                                <th>E-mail</th>
                                <th>Estado</th>
                                <th>Data da requisição</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requisicoes as $requisicao)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$requisicao->codigo}}</td>
                                    <td>{{$requisicao->nome}}</td>
                                    <td>{{$requisicao->contacto}}</td>
                                    <td>{{$requisicao->email}}</td>
                                    <td><span class="badge badge-{{($requisicao->estado == 'Pendente') ? 'warning' : 'success'}}">{{$requisicao->estado}} </span></td>
                                    <td>{{date('d-m-Y', strtotime($requisicao->created_at))}}</td>
                                    <td>
                                        @if (Arr::has($permissions, 'requisicao.show')) <a href="{{ route('requisicao.show', [Crypt::encrypt($requisicao->cliente_id), Crypt::encrypt($requisicao->id)]) }}" class="h5 p-r-5"> <i class="fa fa-list-ol" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a> @endif
                                        @if ($requisicao->estado == 'Pendente' && Arr::has($permissions, 'requisicao.answer')) <a href="{{ route('requisicao.answer', Crypt::encrypt($requisicao->id)) }}" class="h5"> <i class="fa fa-send" data-bs-toggle="tooltip" data-bs-placement="top" title="Responder"></i></a> @endif
                                        @if ($requisicao->estado == 'Pendente' && Arr::has($permissions, 'requisicao.answer')) <a href="{{ route('requisicao.answer', Crypt::encrypt($requisicao->id)) }}" class="h5"> <i class="fa fa-send" data-bs-toggle="tooltip" data-bs-placement="top" title="Responder"></i></a> @endif
                                        @if (Arr::has($permissions, 'requisicao.delete')) <a href="#" class="h5 p-l-5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$requisicao->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="delete_modal_{{$requisicao->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('requisicao.delete', Crypt::encrypt($requisicao->id)) }}" method="POST">
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
