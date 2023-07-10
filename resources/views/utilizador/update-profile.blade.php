@extends('layouts.simple.master')
@section('title', 'Utilizador')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Utilizador</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Utilizador</li>
<li class="breadcrumb-item">Perfil</li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="edit-profile">
		<div class="row">
			<div class="col-xl-4">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">Utilizador</h4>
						<div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
					</div>
					<form action="{{ route('utilizador.profile.put') }}" method="POST">
                        @csrf
                        <div class="card-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="col-form-label">Nome <span style="color: red">*</span></label>
                                        <input class="form-control" type="text" name="nome" value="{{ $user->name }}" placeholder="Digite o nome do utilizador">
                                        @error('nome') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email <span style="color: red">*</span></label>
                                        <input class="form-control" name="email" value="{{ $user->email }}" placeholder="email@dominio.com">
                                        @error('email') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Senha <span style="color: red">*</span></label>
                                        <input class="form-control" type="password" name="senha" value="" placeholder="Digite a senha">
                                        @error('senha') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Confirmação da Senha <span style="color: red">*</span></label>
                                        <input class="form-control" type="password" name="senha_confirmation" value="" placeholder="Confirme a senha">
                                        @error('senha_confirmation') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                        </div>
				    </form>
				</div>
			</div>
			<div class="col-xl-8">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">Perfil</h4>
						<div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
					</div>
                    <form action="{{ route('utilizador.pessoa.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Nome <span style="color: red">*</span></label>
                                        <input class="form-control" type="text" name="nome" value="{{ $user->pessoa_nome }}" placeholder="Digite o primeiro nome">
                                        @error('nome') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Apelido <span style="color: red">*</span></label>
                                        <input class="form-control" type="text" name="apelido" value="{{ $user->pessoa_apelido }}" placeholder="Digite o apelido">
                                        @error('apelido') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Data de Nascimento <span style="color: red">*</span></label>
                                        <div class="input-group">
                                            <input class="form-control digits" type="date" max="{{date('Y-m-d')}}" name="data_de_nascimento" value="{{ $user->pessoa_data_nascimento }}">
                                        </div>
                                        @error('data_de_nascimento') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label">Gênero <span style="color: red">*</span></label>
                                        <select class="js-example-basic-single col-sm-12" name="genero">
                                            <option value="">Escolha uma opcção</option>
                                            @foreach ($generos as $genero)
                                                <option value="{{$genero->id}}" {{($user->pessoa_genero == $genero->id) ? 'selected' : ''}}>{{$genero->nome}}</option>
                                            @endforeach
                                        </select>
                                        @error('genero') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label">Estado Civil</label>
                                        <select class="js-example-basic-single col-sm-12" name="estado_civil">
                                            <option value="">Escolha uma opcção</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{$estado->id}}" {{($user->pessoa_estado_civil == $estado->id) ? 'selected' : ''}}>{{$estado->nome}}</option>
                                            @endforeach
                                        </select>
                                        @error('estado_civil') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="col-form-label">Tipo de doc. de identificação <span style="color: red">*</span></label>
                                        <select class="js-example-basic-single col-sm-12" name="documento">
                                            <option value="">Escolha uma opcção</option>
                                            @foreach ($documentos as $documento)
                                                <option value="{{$documento->id}}" {{($user->pessoa_tipo_documento == $documento->id) ? 'selected' : ''}}>{{$documento->nome}}</option>
                                            @endforeach
                                        </select>
                                        @error('documento') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Nº do doc. de identif. <span style="color: red">*</span></label>
                                        <input class="form-control" type="text" name="numero_documento" value="{{$user->pessoa_numero_documento}}" placeholder="Digite o nº do documento de identificação">
                                        @error('numero_documento') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Contacto <span style="color: red">*</span></label>
                                        <input class="form-control" type="text" name="contacto" value="{{$user->pessoa_contacto}}" placeholder="Digite o contacto">
                                        @error('contacto') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Contacto Alternativo</label>
                                        <input class="form-control" type="text" name="contacto_alternativo" value="{{$user->pessoa_contacto_alt}}" placeholder="Digite o contacto alternativo">
                                        @error('contacto_alternativo') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Nuit</label>
                                        <input class="form-control" type="text" name="nuit" value="{{$user->pessoa_nuit}}" placeholder="Digite o nº do nuit">
                                        @error('nuit') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Inss</label>
                                        <input class="form-control" type="text" name="inss" value="{{$user->pessoa_inss}}" placeholder="Digite o nº do inss">
                                        @error('inss') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="col-form-label">Morada</label>
                                        <input class="form-control" type="text" name="morada" value="{{$user->pessoa_morada}}" placeholder="Digite a morada">
                                        @error('morada') <span style="color: red">{{$message}}.</span> @enderror
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
