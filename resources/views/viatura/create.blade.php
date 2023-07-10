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
<li class="breadcrumb-item active">Criar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Criar</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" action="{{ route('viatura.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h6>Dados básicos</h6>
                        <div class="row">
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Marca <span style="color: red">*</span></label>
                              <select class="js-example-basic-single col-sm-12" name="marca">
                                 <option value="">Escolha uma opcção</option>
                                 @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}" {{(old('marca') == $marca->id) ? 'selected' : ''}}>{{$marca->nome}}</option>
                                 @endforeach
                              </select>
                              @error('marca') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Tipo <span style="color: red">*</span></label>
                              <select class="js-example-basic-single col-sm-12" name="tipo">
                                 <option value="">Escolha uma opcção</option>
                                 @foreach ($viatura_tipos as $tipo)
                                    <option value="{{$tipo->id}}" {{(old('tipo') == $tipo->id) ? 'selected' : ''}}>{{$tipo->nome}}</option>
                                 @endforeach
                              </select>
                              @error('tipo') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Modelo <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="modelo" value="{{old('modelo')}}" placeholder="Digite o modelo">
                              @error('modelo') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-2">
                              <label class="col-form-label">Ano de fabrico <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="number" min="1960" max="{{date('Y', strtotime('+1 year'))}}" name="ano_de_fabrico" placeholder="Ano de fabrico" value="{{old('ano_de_fabrico')}}" >
                              </div>
                              @error('ano_de_fabrico') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-1">
                              <label class="col-form-label">Lotação<span style="color: red">*</span></label>
                              <input class="form-control" type="number" name="lotacao" min="1" value="{{(old('lotacao')) ? old('lotacao') : 1}}">
                              @error('lotacao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                        <div class="row">
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Matrícula <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="matricula" value="{{old('matricula')}}" placeholder="Digite o matrícula">
                              @error('matricula') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Livrete <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="livrete" value="{{old('livrete')}}" placeholder="Digite o livrete">
                              @error('livrete') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Nº do Chassi <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="chassi" value="{{old('chassi')}}" placeholder="Digite o número do chassi">
                              @error('chassi') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Nº do motor <span style="color: red">*</span></label>
                              <input class="form-control" type="text" name="motor" value="{{old('motor')}}" placeholder="Digite o número do motor">
                              @error('motor') <span style="color: red">{{$message}}.</span> @enderror
                                    
                            </div>
                        </div>
                        <div class="row">
                           <div class="col">
                              <div class="mb-3 mb-0">
                                 <label for="descricao">Descrição</label>
                                 <textarea class="form-control" name="descricao" rows="3">{{old('descricao')}}</textarea>
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
                                       <option value="{{$combustivel->id}}" {{(old('combustivel') == $combustivel->id) ? 'selected' : ''}}>{{$combustivel->nome}}</option>
                                    @endforeach
                              </select>
                              @error('combustivel') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-4">
                              <label class="col-form-label">Consumo médio (l/km) <span style="color: red">*</span></label>
                              <input class="form-control" type="number" step="0.01" min="0.1" max="1" name="consumo_medio" value="{{old('consumo_medio')}}" placeholder="Digite o consumo médio">
                              @error('consumo_medio') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-4">
                              <label class="col-form-label">Capacidade do tanque (l) <span style="color: red">*</span></label>
                              <input class="form-control" type="number" name="capacidade_do_tanque" min="1" value="{{old('capacidade_do_tanque')}}" placeholder="Digite a capacidade do tanque">
                              @error('capacidade_do_tanque') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                        <hr class="mt-4 mb-4">
                        <h6>Dados da kilometragem</h6>
                        <div class="row">
                           <div class="mb-3 col-md-4">
                              <label class="col-form-label">Kilometragem <span style="color: red">*</span></label>
                              <input class="form-control" type="number" name="kilometragem" min="0" value="{{old('kilometragem')}}" placeholder="Digite a kilometragem da viatura">
                              @error('kilometragem') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                        </div>
                        <hr class="mt-4 mb-4">
                        <h6>Documentos da viaturas</h6>
                        <div class="row">
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Inspecção: Data de Emissão <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d')}}" name="inspeccao_data_emissao" value="{{old('inspeccao_data_emissao')}}">
                              </div>
                              @error('inspeccao_data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Inspecção: Data de Validade <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d', strtotime('+1 day'))}}" name="inspeccao_data_validade" value="{{old('inspeccao_data_validade')}}">
                              </div>
                              @error('inspeccao_data_validade') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Manifesto: Data de Emissão <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d')}}" name="manifesto_data_emissao" value="{{old('manifesto_data_emissao')}}">
                              </div>
                              @error('manifesto_data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Manifesto: Data de Validade <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d', strtotime('+1 day'))}}" name="manifesto_data_validade" value="{{old('manifesto_data_validade')}}">
                              </div>
                              @error('manifesto_data_validade') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Seguro: Data de Emissão <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d')}}" name="seguro_data_emissao" value="{{old('seguro_data_emissao')}}">
                              </div>
                              @error('seguro_data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Seguro: Data de Validade <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d', strtotime('+1 day'))}}" name="seguro_data_validade" value="{{old('seguro_data_validade')}}">
                              </div>
                              @error('seguro_data_validade') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Taxa de rádio: Data de Emissão <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d')}}" name="taxa_radio_data_emissao" value="{{old('taxa_radio_data_emissao')}}">
                              </div>
                              @error('taxa_radio_data_emissao') <span style="color: red">{{$message}}.</span> @enderror
                           </div>
                           <div class="mb-3 col-md-3">
                              <label class="col-form-label">Taxa de rádio: Data de Validade <span style="color: red">*</span></label>
                              <div class="input-group">
                                 <input class="form-control digits" type="date" min="{{date('Y-m-d', strtotime('+1 day'))}}" name="taxa_radio_data_validade" value="{{old('taxa_radio_data_validade')}}">
                              </div>
                              @error('taxa_radio_data_validade') <span style="color: red">{{$message}}.</span> @enderror
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
                    <button type="button" class="btn btn-danger">Cancelar</button>
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
