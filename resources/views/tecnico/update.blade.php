@extends('layouts.simple.master')
@section('title', 'Técnico')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Técnico</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Técnico</li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Editar</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('tecnico.put', Crypt::encrypt($tecnico->id)) }}" method="POST">
                @csrf
                <div class="card-body">
                    <h6>Informação básica</h6>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Nome <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="nome" value="{{ $tecnico->nome }}" placeholder="Digite o primeiro nome">
                                @error('nome') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Apelido <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="apelido" value="{{ $tecnico->apelido }}" placeholder="Digite o apelido">
                                @error('apelido') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Data de Nascimento <span style="color: red">*</span></label>
								<div class="input-group">
									<input class="form-control digits" type="date" name="data_de_nascimento" max="{{date('Y-m-d', strtotime('-18 years'))}}" value="{{ $tecnico->data_nascimento }}">
								</div>
                                @error('data_de_nascimento') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Gênero <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="genero">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($generos as $genero)
                                        <option value="{{$genero->id}}" {{($tecnico->genero_id == $genero->id) ? 'selected' : ''}}>{{$genero->nome}}</option>
                                    @endforeach
                                </select>
                                @error('genero') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Estado Civil</label>
                                <select class="js-example-basic-single col-sm-12" name="estado_civil">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{$estado->id}}" {{($tecnico->estado_civil_id == $estado->id) ? 'selected' : ''}}>{{$estado->nome}}</option>
                                    @endforeach
                                </select>
                                @error('estado_civil') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Tipo de documento de identificação <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="documento">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($documentos as $documento)
                                        <option value="{{$documento->id}}" {{($tecnico->tipo_documento_id == $documento->id) ? 'selected' : ''}}>{{$documento->nome}}</option>
                                    @endforeach
                                </select>
                                @error('documento') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Número do documento de identificação <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="numero_documento" value="{{ $tecnico->numero_documento }}" placeholder="Digite o nº do documento de identificação">
                                @error('numero_documento') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Contacto <span style="color: red">*</span></label>
                                <input class="form-control" type="text" name="contacto" value="{{ $tecnico->contacto }}" placeholder="Digite o contacto">
                                @error('contacto') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Contacto Alternativo</label>
                                <input class="form-control" type="text" name="contacto_alternativo" value="{{ $tecnico->contacto_alt }}" placeholder="Digite o contacto alternativo">
                                @error('contacto_alternativo') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                        <hr class="mt-4 mb-4">
                        <h6>Outras Informações</h6>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="col-form-label">Especialidade <span style="color: red">*</span></label>
                                    <select class="js-example-basic-single col-sm-12" name="especialidade">
                                        <option value="">Escolha uma opcção</option>
                                        @foreach ($especialidades as $especialidade)
                                            <option value="{{$especialidade->id}}" {{($tecnico->especialidade_id == $especialidade->id) ? 'selected' : ''}}>{{$especialidade->nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('especialidade') <span style="color: red">{{$message}}.</span> @enderror
                                </div>
                            </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('tecnico.list') }}" class="btn btn-danger">Cancelar</a>
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
