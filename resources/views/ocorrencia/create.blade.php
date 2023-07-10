@extends('layouts.simple.master')
@section('title', 'Ocorrência')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Ocorrência</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Ocorrência</li>
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
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('ocorrencia.store') }}" method="POST">
                @csrf
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                               <div class="mb-3 mb-0">
                                  <label for="descricao">Descrição do motorista <span style="color: red">*</span></label>
                                  <textarea class="form-control" name="descricao_motorista" rows="5">{{old('descricao_motorista')}}</textarea>
                               </div>
                               @error('descricao_motorista') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="col-md-12">
                               <div class="mb-3 mb-0">
                                  <label for="descricao">Descrição da inspecção <span style="color: red">*</span></label>
                                  <textarea class="form-control" name="descricao_inspeccao" rows="5">{{old('descricao_inspeccao')}}</textarea>
                               </div>
                               @error('descricao_inspeccao') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Tipo de ocorrência <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="tipo">
                                    <option value="">Escolha uma opcção</option>
                                    <option value="Informativa">Informativa</option>
                                    <option value="Acção Necessária">Acção Necessária</option>
                                </select>
                                @error('tipo') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                               <label class="col-form-label">Data e hora da ocorrência <span style="color: red">*</span></label>
                               <div class="input-group">
                                  <input class="form-control digits" type="datetime-local" min="{{date('Y-m-d').'T'.date('00:00')}}" max="{{date('Y-m-d').'T'.date('H:i')}}" name="data_hora_ocorrencia" value="{{old('data_hora_ocorrencia')}}">
                               </div>
                               @error('data_hora_ocorrencia') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Motorista <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="motorista">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($motoristas as $motorista)
                                        <option value="{{$motorista->id}}" {{(old('motorista') == $motorista->id) ? 'selected' : ''}}>{{$motorista->nome . ' ' . $motorista->apelido}}</option>
                                    @endforeach
                                </select>
                                @error('motorista') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Viatura <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="viatura" onchange="javascript:getViaturaInfo(this.value)">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($viaturas as $viatura)
                                        <option value="{{$viatura->id}}" {{(old('viatura') == $viatura->id) ? 'selected' : ''}}>{{$viatura->matricula}}</option>
                                    @endforeach
                                </select>
                                @error('viatura') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Kilometragem actual (km)  <i class="fa fa-spin fa-spinner" id="loader_odometro" style="display: none"></i></label>
                                <input class="form-control" type="number" min="0" name="kilometragem" id="kilometragem" value="{{old('kilometragem')}}" placeholder="Kilometragem actual da viatura" disabled>
                                @error('kilometragem') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('ocorrencia.list') }}" class="btn btn-danger">Cancelar</a>
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

<script>
    function getViaturaInfo(id) {
        if (id) {
            $('#loader_odometro').removeAttr( 'style' );

            $.ajax({
                    url:"{{ route('viatura.getViaturaInfo') }}",
                    type:"GET",
                    data:{id:id},
                    success: function(data) {

                        document.getElementById('kilometragem').value = parseInt(data['odometer'])

                        $('#loader_odometro').css( 'display', 'none');
                    }
            });
        } else {
            document.getElementById('kilometragem').value = ''
            document.getElementById('kilometragem').setAttribute('placeholder', 'XYZ km')
        }
    }

</script>
@endsection
