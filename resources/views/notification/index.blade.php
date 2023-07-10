@extends('layouts.simple.master')
@section('title', 'Notificações')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Notificações</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Notificações</li>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @if ($nr_notifications > 0) <th colspan="4"><a href="{{ route('notificacao.read.all') }}" class="h6 f-right"> <i class="fa fa-check-square-o"></i> Marcar todas como lidas </a> </th> @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notificacoes as $notificacao)
                                <tr>
                                    <td><i class="fa fa-circle-o me-3 font-primary"> </i></td>
                                    <td>
                                        <b> {{$notificacao->data['name']}}</b><br>
                                        {{$notificacao->data['msg']}}
                                    </td>
                                    <td>{{ (date('Y-m-d', strtotime($notificacao->created_at)) == date('Y-m-d')) ? date('H:i', strtotime($notificacao->created_at)) : date('d/m', strtotime($notificacao->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route($notificacao->data['route'], $notificacao->data['params']) }}" class="h5 p-r-5"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        <a href="{{ route('notificacao.read', Crypt::encrypt($notificacao->id)) }}" class="h5 p-l-5"> <i class="fa fa-check-square-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Marcar como lida"></i></a>
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
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
