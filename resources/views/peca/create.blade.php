@extends('layouts.simple.master')
@section('title', 'Peças')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Peças</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Peças</li>
    <li class="breadcrumb-item active">Criar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Criar</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('pecas.store') }}" method="POST">
                @csrf
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Designação <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="designacao" value="{{old('designacao')}}" placeholder="Digite a designação">
                                @error('designacao') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Custo da peça <span style="color: red">*</span></label>
                                <input class="form-control" type="number" min="1" name="custo_da_peca" value="{{old('custo_da_peca')}}" placeholder="Digite o custo da peça">
                                @error('custo_da_peca') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                                <label class="col-form-label">Quantidade Inicial <span style="color: red">*</span> <i class="fa fa-question-circle font-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Esta é a quantidade da peça no momento do registo!"></i>  <i class="fa fa-spin fa-spinner" id="loader_distance_calc" style="display: none"></i></label>
                                <input class="form-control" type="number" min="1" name="quantidade_inicial" value="{{old('quantidade_inicial')}}" placeholder="Digite a quantidade inicial da peça">
                                @error('quantidade_inicial') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                                <label class="col-form-label">Quantidade mínima <span style="color: red">*</span> <i class="fa fa-question-circle font-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Esta é a quantidade mínima da peça no inventário!"></i>  <i class="fa fa-spin fa-spinner" id="loader_distance_calc" style="display: none"></i></label>
                                <input class="form-control" type="number" min="1" name="quantidade_minima" value="{{old('quantidade_minima')}}" placeholder="Digite a quantidade mínima da peça">
                                @error('quantidade_minima') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="col-md-12">
                               <div class="mb-3 mb-0">
                                  <label for="descricao">Descrição</label>
                                  <textarea class="form-control" name="descricao" rows="5">{{old('descricao')}}</textarea>
                               </div>
                               @error('descricao') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('pecas.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Registar</button>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection
