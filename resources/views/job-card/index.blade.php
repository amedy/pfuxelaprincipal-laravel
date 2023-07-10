@extends('layouts.simple.master')
@section('title', 'Job Card')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Job Card</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Job Card</li>
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
                                <th>viatura</th>
                                <th>Data e Hora</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$job->codigo}}</td>
                                    <td>{{($job->viatura_1) ? $job->viatura_1 : $job->viatura_2}}</td>
                                    <td>{{($job->data_hora) ? date('d-m-Y, H:i', strtotime($job->data_hora)) : date('d-m-Y, H:i', strtotime($job->created_at))}}</td>
                                    <td>
                                        @if (Arr::has($permissions, 'job-card.show')) <a href="{{ route('job-card.show', Crypt::encrypt($job->id)) }}" class="h5 p-r-5"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a> @endif
                                        @if (Arr::has($permissions, 'job-card.update')) <a href="{{ route('job-card.update', Crypt::encrypt($job->id)) }}" class="h5"> <i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a> @endif
                                        @if (Arr::has($permissions, 'job-card.jobs')) <a href="{{ route('job-card.jobs', Crypt::encrypt($job->id)) }}" class="h5"> <i class="fa fa-wrench" data-bs-toggle="tooltip" data-bs-placement="top" title="Adicionar trabalhos efectuados"></i></a> @endif
                                        @if (Arr::has($permissions, 'job-card.delete')) <a href="#" class="h5 p-l-5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$job->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="delete_modal_{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('job-card.delete', Crypt::encrypt($job->id)) }}" method="POST">
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
