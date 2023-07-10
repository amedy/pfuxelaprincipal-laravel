@extends('layouts.simple.master')
@section('title', 'Viatura')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Viatura</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Viatura</li>
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
                                <th>Matrícula</th>
                                <th>Tipo de combustível</th>
                                <th>Qtd. de combustível</th>
                                <th>Localização</th>
                                <th>Odômetro</th>
                                <th>Opcções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viaturas as $viatura)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$viatura->matricula}}</td>
                                    <td>{{$viatura->combustivel}}</td>
                                    <td>{{number_format($viatura->combustivel_disponivel, 2, '.')}} l</td>
                                    <td>{{$viatura->localizacao}}</td>
                                    <td>{{number_format($viatura->odometro)}} km</td>
                                    <td>
                                        <a href="#" class="h5 p-r-5" data-bs-toggle="modal" data-bs-target="#details_modal_{{$viatura->id}}"> <i class="fa fa-list-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a>
                                        @if (Arr::has($permissions, 'viatura.update')) <a href="{{ route('viatura.update', Crypt::encrypt($viatura->id)) }}" class="h5"> <i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a> @endif
                                        @if (Arr::has($permissions, 'viatura.docs.update')) <a href="{{ route('viatura.docs.update', Crypt::encrypt($viatura->id)) }}" class="h5"> <i class="fa fa-book" data-bs-toggle="tooltip" data-bs-placement="top" title="Documentos da viatura"></i></a> @endif
                                        @if (Arr::has($permissions, 'viatura.delete')) <a href="#" class="h5 p-l-5 txt-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$viatura->id}}"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a> @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="details_modal_{{$viatura->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalhes</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Dados básicos</h6>
                                                    <div class="row">
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Marca</label>
                                                          <input class="form-control" type="text" value="{{$viatura->marca}}" placeholder="-" readonly>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Tipo</label>
                                                          <input class="form-control" type="text" value="{{$viatura->tipo}}" placeholder="-" readonly>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Modelo</label>
                                                          <input class="form-control" type="text" value="{{$viatura->modelo}}" placeholder="-" readonly>
                                                       </div>
                                                       <div class="mb-3 col-md-2">
                                                          <label class="col-form-label">Ano de fabrico</label>
                                                          <div class="input-group">
                                                             <input class="datepicker-here form-control digits" value="{{$viatura->ano_fabrico}}" type="text" data-language="en" data-position="bottom left" placeholder="Ano de fabrico" data-min-view="years" data-view="years" data-date-format="yyyy" readonly>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-1">
                                                          <label class="col-form-label">Lot.</label>
                                                          <input class="form-control" type="text" value="{{$viatura->lotacao}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lotação" readonly>
                                                       </div>
                                                    </div>
                                                    <div class="row">
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Matrícula</label>
                                                          <input class="form-control" type="text" value="{{$viatura->matricula}}" placeholder="-" readonly>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Livrete</label>
                                                          <input class="form-control" type="text" value="{{$viatura->nr_livrete}}" placeholder="-" readonly>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Nº do Chassi</label>
                                                          <input class="form-control" type="text" value="{{$viatura->nr_chassi}}" placeholder="-" readonly>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Nº do motor</label>
                                                          <input class="form-control" type="text" value="{{$viatura->nr_motor}}" placeholder="-" readonly>
                                                       </div>
                                                    </div>
                                                    <div class="row">
                                                       <div class="col">
                                                          <div class="mb-3 mb-0">
                                                             <label for="descricao">Descrição</label>
                                                             <textarea class="form-control" rows="3" readonly>{{$viatura->descricao}}</textarea>
                                                          </div>
                                                       </div>
                                                    </div>
                                                <hr class="mt-4 mb-4">
                                                <h6>Dados do combustível</h6>
                                                    <div class="row">
                                                       <div class="mb-3 col-md-4">
                                                          <label class="col-form-label">Combustível</label>
                                                          <input class="form-control" type="text" value="{{$viatura->combustivel}}" placeholder="-" readonly>
                                                       </div>
                                                       <div class="mb-3 col-md-4">
                                                          <label class="col-form-label">Consumo médio </label>
                                                          <div class="input-group mb-3">
                                                            <input class="form-control" type="number" value="{{$viatura->consumo_medio}}" placeholder="-" readonly>
                                                              <div class="input-group-append"><span class="input-group-text">l/km</span></div>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-4">
                                                          <label class="col-form-label">Capacidade do tanque</label>
                                                          <div class="input-group mb-3">
                                                            <input class="form-control" type="number" value="{{$viatura->capacidade_tanque}}" placeholder="-" readonly>
                                                              <div class="input-group-append"><span class="input-group-text">l</span></div>
                                                          </div>
                                                       </div>
                                                    </div>
                                                <hr class="mt-4 mb-4">
                                                <h6>Estado da viatura</h6>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Combustível Disponível</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" type="text" value="{{number_format($viatura->combustivel_disponivel, 2, '.')}}" placeholder="-" readonly>
                                                                <div class="input-group-append"><span class="input-group-text">l</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Kilometragem de registo</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" type="text" value="{{number_format($viatura->odometro_registo)}}" placeholder="-" readonly>
                                                                <div class="input-group-append"><span class="input-group-text">km</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Kilometragem actual</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" type="text" value="{{number_format($viatura->odometro)}}" placeholder="-" readonly>
                                                                <div class="input-group-append"><span class="input-group-text">km</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="col-form-label">Localizacao</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" type="text" value="{{$viatura->localizacao}}" placeholder="-" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <hr class="mt-4 mb-4">
                                                <h6>Documentos da viaturas</h6>
                                                    <div class="row">
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Insp.: Data de Emissão</label>
                                                          <div class="input-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Inspecção">
                                                             <input class="datepicker-here form-control digits" name="inspeccao_data_emissao" value="{{date('m/d/Y', strtotime($viatura->inspeccao_emissao))}}" type="text" placeholder="Data de emissão" data-language="en" data-position="bottom left" readonly>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Insp.: Data de Validade</label>
                                                          <div class="input-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Inspecção">
                                                             <input class="datepicker-here form-control digits" name="inspeccao_data_validade" value="{{date('m/d/Y', strtotime($viatura->inspeccao_validade))}}" type="text" placeholder="Data de validade" data-language="en" data-position="bottom left" readonly>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Manif.: Data de Emissão</label>
                                                          <div class="input-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Manifesto">
                                                             <input class="datepicker-here form-control digits" name="manifesto_data_emissao" value="{{date('m/d/Y', strtotime($viatura->manifesto_emissao))}}" type="text" placeholder="Data de emissão" data-language="en" data-position="bottom left" readonly>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Manif.: Data de Validade</label>
                                                          <div class="input-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Manifesto">
                                                             <input class="datepicker-here form-control digits" name="manifesto_data_validade" value="{{date('m/d/Y', strtotime($viatura->manifesto_validade))}}" type="text" placeholder="Data de validade" data-language="en" data-position="bottom left" readonly>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Seguro: Data de Emissão</label>
                                                          <div class="input-group">
                                                             <input class="datepicker-here form-control digits" name="seguro_data_emissao" value="{{date('m/d/Y', strtotime($viatura->seguro_emissao))}}" type="text" placeholder="Data de emissão" data-language="en" data-position="bottom left" readonly>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">Seguro: Data de Validade</label>
                                                          <div class="input-group">
                                                             <input class="datepicker-here form-control digits" name="seguro_data_validade" value="{{date('m/d/Y', strtotime($viatura->seguro_validade))}}" type="text" placeholder="Data de validade" data-language="en" data-position="bottom left" readonly>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">T. rádio: Data de Emissão</label>
                                                          <div class="input-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Taxa de rádio">
                                                             <input class="datepicker-here form-control digits" name="taxa_radio_data_emissao" value="{{date('m/d/Y', strtotime($viatura->taxa_radio_emissao))}}" type="text" placeholder="Data de emissão" data-language="en" data-position="bottom left" readonly>
                                                          </div>
                                                       </div>
                                                       <div class="mb-3 col-md-3">
                                                          <label class="col-form-label">T. rádio: Data de Validade</label>
                                                          <div class="input-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Taxa de rádio">
                                                             <input class="datepicker-here form-control digits" name="taxa_radio_data_validade" value="{{date('m/d/Y', strtotime($viatura->taxa_radio_validade))}}" type="text" placeholder="Data de validade" data-language="en" data-position="bottom left" readonly>
                                                          </div>
                                                       </div>
                                                    </div>
                                                <hr class="mt-4 mb-4">
                                                <h6>Anexos</h6>
                                                    <div class="file-content">
                                                        <div class="row file-manager">
                                                            @foreach ($anexos as $anexo)
                                                                @if ($anexo->viatura_id == $viatura->id)
                                                                    <ul class="files">
                                                                        <li class="file-box">
                                                                            <a href="{{ asset($anexo->path) }}" target="_blank">
                                                                                <div class="file-top">  <i class="fa fa-file-pdf-o txt-secondary"></i></div>
                                                                                <div class="file-bottom">
                                                                                    <h6>{{ $anexo->nome }}</h6>
                                                                                    {{-- <p class="mb-1">1.90 GB</p> --}}
                                                                                    <p>{{ date('d/m/Y', strtotime($anexo->created_at)) }}</p>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                @endif
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
                                <div class="modal fade" id="delete_modal_{{$viatura->id}}" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('viatura.delete', Crypt::encrypt($viatura->id)) }}" method="POST">
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
