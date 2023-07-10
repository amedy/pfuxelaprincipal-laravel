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
<li class="breadcrumb-item">Reabastecimentos</li>
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
                                <th>Factura</th>
                                <th>Quantidade abastecida (litros)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reabastecimentos as $reabastecimento)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$reabastecimento->codigo}}</td>
                                    <td>{{$reabastecimento->factura}}</td>
                                    <td>{{$reabastecimento->quantidade_abastecida}} l</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="#" onclick="window.close();return false;" class="btn btn-danger">Fechar</a>
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
