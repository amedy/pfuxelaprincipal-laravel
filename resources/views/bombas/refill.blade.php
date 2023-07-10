@extends('layouts.simple.master')
@section('title', 'Bombas')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Bombas</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Bombas</li>
    <li class="breadcrumb-item active">Reabastecer</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Reabastecer</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('bombas.refill.store', Crypt::encrypt($bomba->id)) }}" method="POST">
                @csrf
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Factura</label>
                                <input class="form-control" type="text" name="factura" value="{{ old('factura') }}" placeholder="Digite o número da factura do reabastecimento">
                                @error('factura') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label">Quantidade actual (l) <span style="color: red">*</span></label>
                              <input class="form-control" type="number" name="quantidade_anterior" value="{{ $bomba->disponivel }}" placeholder="-" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                              <label class="col-form-label">Quantidade por abastecer (l) </label>
                              <input class="form-control" type="number" name="quantidade" min="0" max="{{ $bomba->capacidade - $bomba->disponivel }}" value="{{ old('quantidade') }}" placeholder="Digite a quantidade por abastecer">
                              @error('quantidade') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('bombas.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Registar</button>
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
