@extends('layouts.simple.master')
@section('title', 'Viatura')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Viatura</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Viatura</li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Editar</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" action="{{ route('viatura.put', Crypt::encrypt($viatura->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h6>Dados básicos</h6>
                        <div class="row">
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Marca <span style="color: red">*</span></label>
                              <select class="js-example-basic-single col-sm-12" name="marca">
                                 <option value="">Escolha uma opcção</option>
                                 @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}" {{(old('marca') == $marca->id || $viatura->marca_id == $marca->id) ? 'selected' : ''}}>{{$marca->nome}}</option>
                                 @endforeach
                              </select>
                              @error('marca') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Tipo <span style="color: red">*</span></label>
                              <select class="js-example-basic-single col-sm-12" name="tipo">
                                 <option value="">Escolha uma opcção</option>
                                 @foreach ($viatura_tipos as $tipo)
                                    <option value="{{$tipo->id}}" {{(old('tipo') == $tipo->id || $viatura->tipo_id == $tipo->id) ? 'selected' : ''}}>{{$tipo->nome}}</option>
                                 @endforeach
                              </select>
                              @error('tipo') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Modelo <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="modelo" value="{{$viatura->modelo}}" placeholder="Digite o modelo">
                              @error('modelo') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-2">
                              <label class="col-form-label">Ano de fabrico <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="number" min="1960" max="{{date('Y', strtotime('+1 year'))}}" name="ano_de_fabrico" value="{{$viatura->ano_fabrico}}">
                              </div>
                              @error('ano_de_fabrico') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-1">
                              <label class="col-form-label">Lotação<span style="color: red">*</span></label>
                              <input class="form-control" type="number" name="lotacao" min="1" value="{{$viatura->lotacao}}">
                              @error('lotacao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                        <div class="row">
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Matrícula <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="matricula" value="{{$viatura->matricula}}" placeholder="Digite o matrícula">
                              @error('matricula') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Livrete <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="livrete" value="{{$viatura->nr_livrete}}" placeholder="Digite o livrete">
                              @error('livrete') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Nº do Chassi <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="chassi" value="{{$viatura->nr_chassi}}" placeholder="Digite o número do chassi">
                              @error('chassi') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Nº do motor <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="motor" value="{{$viatura->nr_motor}}" placeholder="Digite o número do motor">
                              @error('motor') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                        <div class="row">
                           <div class="col">
                              <div class="mb-3 mb-0">
                                 <label for="descricao">Descrição</label>
                                 <textarea class="form-control" name="descricao" rows="3">{{$viatura->descricao}}</textarea>
                              </div>
                              @error('descricao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                        <hr class="mt-4 mb-4">
                        <h6>Dados do combustível</h6>
                        <div class="row">
                           <div class="mb-3 col-md-4">
                              <label class="col-form-label">Combustível <span style="color: red">*</span></label>
                                 <select class="js-example-basic-single col-sm-12" name="combustivel">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($combustiveis as $combustivel)
                                       <option value="{{$combustivel->id}}" {{(old('combustivel') == $combustivel->id || $viatura->combustivel_id == $combustivel->id) ? 'selected' : ''}}>{{$combustivel->nome}}</option>
                                    @endforeach
                              </select>
                              @error('combustivel') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-4">
                              <label class="col-form-label">Consumo médio (l/km) <span style="color: red">*</span></label>
                              <input class="form-control" type="number" step="0.01" min="0.1" max="1" name="consumo_medio" value="{{$viatura->consumo_medio}}" placeholder="Digite o consumo médio">
                              @error('consumo_medio') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-4">
                              <label class="col-form-label">Capacidade do tanque (l) <span style="color: red">*</span></label>
                              <input class="form-control" type="number" name="capacidade_do_tanque" min="1" value="{{$viatura->capacidade_tanque}}" placeholder="Digite a capacidade do tanque">
                              @error('capacidade_do_tanque') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                        <hr class="mt-4 mb-4">
                        <h6>Anexos</h6>
                        <div class="row">
                           <div class="mb-3 col-md-6">
                              <label class="col-form-label">Anexos <span style="color: red">*</span></label>
                              <input class="form-control" type="file" name="anexos[]" multiple>
                              @error('anexos') <span style="color: red">{{$message}}.</span> @enderror
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
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
