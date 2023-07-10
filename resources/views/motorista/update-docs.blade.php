@extends('layouts.simple.master')
@section('title', 'Motorista')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Motorista</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Motorista</li>
<li class="breadcrumb-item active">Actualizar carta de condução</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Actualizar carta de condução</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" action="{{ route('motorista.docs.put', Crypt::encrypt($motorista->carta_conducao_id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="col-form-label">Data de Emissão <span style="color: red">*</span></label>
                            <div class="input-group">
                                <input class="form-control digits" type="date" name="data_emissao" min="{{date('Y-m-d')}}" value="{{$motorista->data_emissao}}">
                            </div>
                            @error('data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="col-form-label">Data de Validade <span style="color: red">*</span></label>
                            <div class="input-group">
                                <input class="form-control digits" type="date" name="data_validade" min="{{date('Y-m-d', strtotime('+1 day'))}}" value="{{$motorista->data_validade}}">
                            </div>
                            @error('data_validade') <span style="color: red">{{$message}}.</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('motorista.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection
