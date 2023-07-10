@extends('layouts.simple.master')
@section('title', 'Viatura')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Viatura</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Viatura</li>
<li class="breadcrumb-item active">Editar documentos</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Editar documentos</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" action="{{ route('viatura.docs.put', Crypt::encrypt($viatura->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                        <h6>Documentos da viaturas</h6>
                        <div class="row">
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Inspecção: Data de Emissão <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d')}}" name="inspeccao_data_emissao" value="{{$viatura->inspeccao_emissao}}">
                              </div>
                              @error('inspeccao_data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Inspecção: Data de Validade <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d', strtotime('+1 day'))}}" name="inspeccao_data_validade" value="{{$viatura->inspeccao_validade}}">
                              </div>
                              @error('inspeccao_data_validade') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Manifesto: Data de Emissão <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d')}}" name="manifesto_data_emissao" value="{{$viatura->manifesto_emissao}}">
                              </div>
                              @error('manifesto_data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Manifesto: Data de Validade <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d', strtotime('+1 day'))}}" name="manifesto_data_validade" value="{{$viatura->manifesto_validade}}">
                              </div>
                              @error('manifesto_data_validade') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Seguro: Data de Emissão <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d')}}" name="seguro_data_emissao" value="{{$viatura->seguro_emissao}}">
                              </div>
                              @error('seguro_data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Seguro: Data de Validade <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d', strtotime('+1 day'))}}" name="seguro_data_validade" value="{{$viatura->seguro_validade}}">
                              </div>
                              @error('seguro_data_validade') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Taxa de rádio: Data de Emissão <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d')}}" name="taxa_radio_data_emissao" value="{{$viatura->taxa_radio_emissao}}">
                              </div>
                              @error('taxa_radio_data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Taxa de rádio: Data de Validade <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d', strtotime('+1 day'))}}" name="taxa_radio_data_validade" value="{{$viatura->taxa_radio_validade}}">
                              </div>
                              @error('taxa_radio_data_validade') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('viatura.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
