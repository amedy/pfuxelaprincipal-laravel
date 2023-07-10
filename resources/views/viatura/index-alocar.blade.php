@extends('layouts.simple.master')
@section('title', 'Alocação')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Alocação</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Viatura</li>
<li class="breadcrumb-item">Alocação</li>
<li class="breadcrumb-item active">{{ (Request::route()->getName() == 'viatura.alocar.history') ? 'Histórico' : 'Lista' }}</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               {{-- <h5>Lista</h5> --}}
                <div class="row">
                    <div class="col-md-{{ (Arr::has($permissions, 'viatura.alocar.history')) ? '8' : '10' }}">
                        <h5>{{ (Request::route()->getName() == 'viatura.alocar.history') ? 'Histórico' : 'Lista' }}</h5>
                    </div>
                    <div class="col-md-2">
                        @if (Arr::has($permissions, 'viatura.alocar.create')) <a href="{{ route('viatura.alocar.create') }}" class="btn btn-primary f-right"> <i class="fa fa-plus"></i> Alocar</a> @endif
                    </div>
                    <div class="col-md-2">
                        @if (Arr::has($permissions, 'viatura.alocar.history')) <a href="{{ route('viatura.alocar.' . ((Request::route()->getName() == 'viatura.alocar.history') ? 'list' : 'history')) }}" class="btn btn-primary f-left"> <i class="fa fa-{{ ((Request::route()->getName() == 'viatura.alocar.history') ? 'list' : 'history') }}"></i> {{ (Request::route()->getName() == 'viatura.alocar.history') ? 'Lista' : 'Histórico' }}</a> @endif
                    </div>
                </div>
               {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Viatura</th>
                                <th>Motorista</th>
                                <th>Distância estimada (km)</th>
                                <th>Combustível estimado (litros)</th>
                                <th>Data alocada</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alocacoes as $alocacao)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$alocacao->matricula}}</td>
                                    <td>{{$alocacao->motorista_nome . ' ' . $alocacao->motorista_apelido}}</td>
                                    <td>{{$alocacao->distancia_estimativa}} km</td>
                                    <td>{{number_format($alocacao->combustivel_estimativa, 2, '.')}} l</td>
                                    <td>{{date('d/m/Y', strtotime($alocacao->created_at))}}</td>
                                    <td>
                                        <a href="#" class="h5 p-r-5" data-bs-toggle="modal" data-bs-target="#details_modal_{{$alocacao->id}}"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        @if (Arr::has($permissions, 'viatura.alocar.update')) <a href="{{ route('viatura.alocar.update', Crypt::encrypt($alocacao->id)) }}" class="h5"> <i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a> @endif
                                        @if (Arr::has($permissions, 'viatura.alocar.delete')) <a href="#" class="h5 p-l-5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$alocacao->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="details_modal_{{$alocacao->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalhes</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                   <div class="mb-3 col-md-4">
                                                      <label class="col-form-label">Viatura</label>
                                                      <input class="form-control" type="text" value="{{$alocacao->matricula}}" placeholder="-" readonly>
                                                   </div>
                                                   <div class="mb-3 col-md-4">
                                                      <label class="col-form-label">Motorista</label>
                                                      <input class="form-control" type="text" value="{{$alocacao->motorista_nome . ' ' . $alocacao->motorista_apelido}}" placeholder="-" readonly>
                                                   </div>
                                                   <div class="mb-3 col-md-4">
                                                      <label class="col-form-label">Distância a percorrer (km)</label>
                                                      <input class="form-control" type="text" value="{{$alocacao->distancia_estimativa}}" placeholder="XXX km" readonly>
                                                      <small style="color: red">Estimativa</small>
                                                   </div>
                                                   <div class="mb-3 col-md-4">
                                                      <label class="col-form-label">Combustível necessário (litros)</label>
                                                      <input class="form-control" type="text" value="{{$alocacao->combustivel_estimativa}}" placeholder="XX l" readonly>
                                                      <small style="color: red">Estimativa</small>
                                                   </div>
                                                   <div class="mb-3 col-md-12">
                                                      <label class="col-form-label">Rotas</label>
                                                      @foreach ($rotas_motorista as $rota_motorista)
                                                          @foreach ($rotas as $rota)
                                                              @if ($rota_motorista->rota_id == $rota->id && $rota_motorista->alocacao_id == $alocacao->id)
                                                                <span class="badge badge-success">{{$rota->name}}</span>
                                                              @endif
                                                          @endforeach
                                                      @endforeach
                                                   </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete_modal_{{$alocacao->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('viatura.alocar.delete', Crypt::encrypt($alocacao->id)) }}" method="POST">
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
