@extends('layouts.simple.master')
@section('title', 'Alocação')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Alocação</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Viatura</li>
<li class="breadcrumb-item">Alocação</li>
<li class="breadcrumb-item active">Alocar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Alocar</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" action="{{ route('viatura.alocar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Viaturas <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="viatura" id="viatura" onchange="javascript:getViaturaInfo(this.value)">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($viaturas as $viatura)
                                        <option value="{{$viatura->id}}" {{(old('viatura') == $viatura->id) ? 'selected' : ''}}>{{$viatura->matricula}}</option>
                                    @endforeach
                                </select>
                                @error('viatura') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Kilometragem actual (km)  <i class="fa fa-spin fa-spinner" id="loader_odometro" style="display: none"></i></label>
                               <input class="form-control" type="text" name="odometro" id="odometro" value="{{old('odometro')}}" placeholder="XYZ km" readonly>
                               @error('odometro') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Combustível actual (litros)  <i class="fa fa-spin fa-spinner" id="loader_combustivel" style="display: none"></i></label>
                               <input class="form-control" type="text" name="combustivel" id="combustivel" value="{{old('combustivel')}}" placeholder="XY l" readonly>
                               @error('combustivel') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Distância a percorrer (km)<span style="color: red">*</span></label>
                               <input class="form-control" type="number" name="distancia" id="distancia" min="1" value="{{old('distancia')}}" placeholder="XYZ km" oninput="javascript:calculateDistance(this.value)">
                               <small style="color: red">Estimativa</small>
                               @error('distancia') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Combustível necessário (litros)  <i class="fa fa-spin fa-spinner" id="loader_combustivel_est" style="display: none"></i></label>
                               <input class="form-control" type="text" name="estimativa_combustivel" id="estimativa_combustivel" value="{{old('estimativa_combustivel')}}" placeholder="XY l" readonly>
                               <small style="color: red">Estimativa</small>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Motorista <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="motorista">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($motoristas as $motorista)
                                        <option value="{{$motorista->id}}" {{(old('motorista') == $motorista->id) ? 'selected' : ''}}>{{$motorista->nome . ' ' . $motorista->apelido}}</option>
                                    @endforeach
                                </select>
                                @error('motorista') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="col-form-label">Rotas <span style="color: red">*</span></label>
                                <select class="js-example-basic-multiple col-sm-12" name="rota[]" multiple="multiple">
                                    @foreach ($rotas as $rota)
                                        <option value="{{$rota->id}}">{{$rota->name}}</option>
                                    @endforeach
                                </select>
                                @error('rota') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('viatura.alocar.list') }}" class="btn btn-danger">Cancelar</a>
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

    function calculateDistance(distance) {
        id = $('#viatura').val();
        if (id) {

            $('#loader_combustivel_est').removeAttr( 'style' );
            $.ajax({
                    url:"{{ route('viatura.getViaturaInfo') }}",
                    type:"GET",
                    data:{id:id},
                    success: function(data) {
                        fuel_efficiency = data['fuel_efficiency'] + 0.01;
                        estimativa = parseFloat(fuel_efficiency) * parseFloat(distance)

                        document.getElementById('estimativa_combustivel').value = estimativa.toFixed(2)
                        $('#loader_combustivel_est').css( 'display', 'none');
                    }
            });
        } else {
            notifyError('Distância', 'Antes de digitar a distância estimada deve se escolher a viatura!')
            document.getElementById('distancia').value = ''
            document.getElementById('distancia').setAttribute('placeholder', 'XYZ km')
        }
    }

    function getViaturaInfo(id) {
        if (id) {
            distance = document.getElementById('distancia').value

            $('#loader_odometro').removeAttr( 'style' );
            $('#loader_combustivel').removeAttr( 'style' );

            $.ajax({
                    url:"{{ route('viatura.getViaturaInfo') }}",
                    type:"GET",
                    data:{id:id},
                    success: function(data) {

                        document.getElementById('odometro').value = parseInt(data['odometer'])
                        document.getElementById('combustivel').value = parseFloat(data['fuel'])
                        $("#rota").val(data['rotas']).trigger('change');

                        $('#loader_odometro').css( 'display', 'none');
                        $('#loader_combustivel').css( 'display', 'none');
                    }
            });
            if (distance) {
                calculateDistance(distance);
            }
        } else {
            document.getElementById('combustivel').value = ''
            document.getElementById('combustivel').setAttribute('placeholder', 'XY l')
            document.getElementById('odometro').value = ''
            document.getElementById('odometro').setAttribute('placeholder', 'XYZ km')
        }
    }

</script>
@endsection
