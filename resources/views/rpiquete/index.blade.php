@extends('layouts.simple.master')
@section('title', 'Lista Plano Pedente')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Lista Plano Pedente</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Lista Plano Pedente</li>
<li class="breadcrumb-item active">Lista Plano</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Lista Plano</h5>
               {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Motorista</th>
                                <th>Cliente</th>
                                <th>Tipo de rota</th>
                                <th>Nr.Passageiro</th>
                                <!-- <th>Especificação da Viatura</th>
                                <th>Km Prevista</th> -->
                                <th>Status</th>
                                <th>Editar</th>
         
                            </tr>
                        </thead>
                        <tbody>
                  
                            @foreach ($rpiquetes as $rpiquete)
                                 <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$rpiquete->motorista}}</td>
                                    
                                    <td>{{$rpiquete->cliente}}</td>
                                    <td>{{$rpiquete->local_destino}}</td>
                                    <td>{{$rpiquete->numero_passageiro}}</td>
                                    <!-- <td>{{$rpiquete->espe_viatura}}</td>
                                    <td>{{$rpiquete->km_prevista}}km</td> -->
                                    <td><a href="">{{ $rpiquete->estado?'Enviado':'Pendente' }}</a></td>
                                 <td> <a href="{{ route('rpiquete.update', Crypt::encrypt($rpiquete->id)) }}" class="h5"> <i class="fa fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a></td>
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
