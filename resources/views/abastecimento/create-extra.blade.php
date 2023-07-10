@extends('layouts.simple.master')
@section('title', 'Abastecimento Extraordinário')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Abastecimento Extraordinário</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Abastecimento</li>
    <li class="breadcrumb-item">Extraordinário</li>
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
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('abastecimento.extra.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <h6>Informação básica</h6>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Bombas <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="bombas">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($bombas as $bomba)
                                        <option value="{{$bomba->id}}" {{(old('bombas') == $bomba->id) ? 'selected' : ''}}>{{$bomba->nome}}</option>
                                    @endforeach
                                </select>
                                @error('bombas') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Objectivo <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="objectivo" onchange="javascript:getRoutes(this.value)">
                                    <option value="">Escolha uma opcção</option>
                                    <option value="Rota" {{(old('objectivo') == 'Rota') ? 'selected' : ''}}>Rota</option>
                                    <option value="Teste de Estrada" {{(old('objectivo') == 'Teste de Estrada') ? 'selected' : ''}}>Teste de Estrada</option>
                                    <option value="Especial" {{(old('objectivo') == 'Especial') ? 'selected' : ''}}>Especial</option>
                                    <option value="Reposição de combustível" {{(old('objectivo') == 'Reposição de combustível') ? 'selected' : ''}}>Reposição de combustível</option>
                                    <option value="Apoio" {{(old('objectivo') == 'Apoio') ? 'selected' : ''}}>Apoio</option>
                                    <option value="Compra de Peças" {{(old('objectivo') == 'Compra de Peças') ? 'selected' : ''}}>Compra de Peças</option>
                                    <option value="Serviços Administrativos" {{(old('objectivo') == 'Serviços Administrativos') ? 'selected' : ''}}>Serviços Administrativos</option>
                                </select>
                                @error('objectivo') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            @error('destino') <span style="color: red">{{$message}}.</span> @enderror
                            <div class="mb-3 col-md-3" id="destination" style="{{ (old('destino') == 'Rota') ? 'display: none' : '' }}">
                               <label class="col-form-label">Destino <span style="color: red">*</span></label>
                               <input class="form-control digits" type="text" name="destino" id="destino" placeholder="Digite o destino">
                               @error('destino') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                    <hr>
                    <div class="row m-b-10">
                        <h6>Viatura</h6>
                    </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Viaturas <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="viatura" id="viatura" onchange="javascript:getViaturaInfo(this.value)">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($viaturas as $viatura)
                                        <option value="{{$viatura->id}}" {{(old('viatura') == $viatura->id) ? 'selected' : ''}}>{{$viatura->matricula}}</option>
                                    @endforeach
                                </select>
                                <span>Combustível actual: "<a class="font-primary" id="fuel_actual">--</a>" Litros</span> <br>
                                @error('viatura') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Quantidade (Litros) <span style="color: red">*</span></label>
                               <input class="form-control digits" type="number" name="quantidade" id="quantidade" step="0.1" min="0.1" max="10" placeholder="XY litros" oninput="javascript:updateDistance(this.value)" onchange="javascript:updateDistance(this.value)">
                               <span>Combustível estimado: "<a class="font-primary" id="fuel_estimate">--</a>" Litros</span> <br>
                               @error('quantidade') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Distância estimada (Km) <i class="fa fa-question-circle font-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Esta distância é calculada com base nas rotas alocadas a viatura escolhida neste formulário!"></i>  <i class="fa fa-spin fa-spinner" id="loader_distance_est" style="display: none"></i></label>
                               <input class="form-control digits" type="number" name="distancia_estimada" id="distancia_estimada" min="1" placeholder="XY km" readonly>
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Distância calculada (km) <i class="fa fa-question-circle font-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Esta distância é calculada com base no combustível actual da viatura e na quantidade adicionada neste formulário!"></i>  <i class="fa fa-spin fa-spinner" id="loader_distance_calc" style="display: none"></i></label>
                               <input class="form-control digits" type="number" name="distancia_calculada" id="distancia_calculada" min="1" placeholder="XY km" readonly>
                            </div>
                            <div class="mb-3 col-md-12" style="display: none" id="routes">
                                <label class="col-form-label">Rotas  <i class="fa fa-spin fa-spinner" style="display: none" id="loader_rotas"></i></label>
                                <select class="js-example-basic-multiple col-sm-12" name="rota[]" id="rota" multiple="multiple" disabled>
                                    @foreach ($rotas as $rota)
                                        <option value="{{$rota->id}}">{{$rota->name}}</option>
                                    @endforeach
                                </select>
                                @error('rota') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            @error('rota') <span style="color: red">{{$message}}.</span> @enderror
                            <div class="col-md-12">
                               <div class="mb-3 mb-0">
                                  <label for="descricao">Justificação <span style="color: red">*</span></label>
                                  <textarea class="form-control" name="justificacao" id="justificacao" rows="3">{{old('justificacao')}}</textarea>
                               </div>
                               @error('justificacao') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div id="other">

                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('abastecimento.list') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Enviar</button>
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
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

<script>
    function getViaturaInfo(id) {
        quantity = parseFloat(document.getElementById('fuel_actual').value)
        if (id) {
            if (!quantity) {
                quantity = parseFloat(0)
            }

            $('#loader_distance_est').removeAttr( 'style' );
            $('#loader_distance_calc').removeAttr( 'style' );
            $('#loader_rotas').removeAttr( 'style' );
            $.ajax({
                    url:"{{ route('viatura.getViaturaInfo') }}",
                    type:"GET",
                    data:{id:id},
                    success: function(data) {

                        fuel_efficiency = data['fuel_efficiency'] + 0.01;
                        document.getElementById('fuel_actual').innerHTML = parseFloat(data['fuel'])
                        document.getElementById('fuel_estimate').innerHTML = parseFloat(data['fuel_estimate'])
                        document.getElementById('distancia_estimada').value = parseFloat(data['distance_estimate'])
                        document.getElementById('distancia_calculada').value = (parseFloat(data['fuel']) + quantity) / parseFloat(fuel_efficiency)
                        $("#rota").val(data['rotas']).trigger('change');

                        $('#loader_distance_est').css( 'display', 'none');
                        $('#loader_distance_calc').css( 'display', 'none');
                        $('#loader_rotas').css( 'display', 'none');
                    }
            });

            $.ajax({
                    url:"{{ route('viatura.getOther') }}",
                    type:"GET",
                    data:{id:id},
                    success: function(data) {
                        $('#other').html(data)
                    }
            });
        } else {
            document.getElementById('fuel_actual').innerHTML = '--'
            document.getElementById('fuel_estimate').innerHTML = '--'
            document.getElementById('distancia_estimada').value = ''
            document.getElementById('distancia_calculada').value = ''
            $("#rota").val('').trigger('change');
        }
    }

    function getRoutes(objective) {
        if (objective == 'Rota') {
            $('#routes').removeAttr( 'style' );
            $('#destination').css( 'display', 'none');
        } else {
            $('#destination').removeAttr( 'style' );
            $('#routes').css( 'display', 'none');
        }

        $.ajax({
                url:"{{ route('viatura.switchObjective') }}",
                type:"GET",
                data:{objective:objective},
                success: function(data) {
                    $('#viatura').html(data)
                }
        });
    }

    function updateDistance(quantity) {
        id = document.getElementById('viatura').value
        if (id) {
            $('#loader_distance_calc').removeAttr( 'style' );

            $.ajax({
                    url:"{{ route('viatura.getViaturaInfo') }}",
                    type:"GET",
                    data:{id:id},
                    success: function(data) {

                        fuel_efficiency = data['fuel_efficiency'] + 0.01;
                        document.getElementById('distancia_calculada').value = ((parseFloat(data['fuel']) + parseFloat(quantity)) / parseFloat(fuel_efficiency)).toFixed(2)

                        $('#loader_distance_calc').css( 'display', 'none');
                    }
            });
        }
    }

    function addToOrdens() {
        viatura = document.getElementById('viatura').value
        rotas = $('#rota').val()
        quantidade = document.getElementById('quantidade').value
        distancia_estimada = document.getElementById('distancia_estimada').value
        distancia_calculada = document.getElementById('distancia_calculada').value
        periodo = document.getElementById('periodo').value
        justificacao = document.getElementById('justificacao').value
        combustivel_estimativa = document.getElementById('fuel_estimate').innerHTML

        if (!viatura) {
            notifyError('Viatura', 'Não pode adicionar uma ordem sem antes escolher uma viatura!')
        } else if (!quantidade) {
            notifyError('Quantidade', 'Não pode adicionar uma ordem sem antes digitar a quantidade de combustível necessário!')
        } else if (!periodo) {
            notifyError('Viatura', 'Não pode adicionar uma ordem sem antes escolher o período!')
        } else if (!justificacao) {
            notifyError('Viatura', 'Não pode adicionar uma ordem sem antes digitar a justificação da ordem de abastecimento!')
        } else if (parseInt(quantidade) > parseInt(combustivel_estimativa) || parseInt(quantidade) > 10) {
            notifyError('Quantidade', 'A quantidade de combustível não pode ser maior que o combustível estimado ou maior que 10 litros!')
        } else {
            $('#loader_button').removeAttr( 'class' );
            $('#loader_button').attr( 'class', 'fa fa-spin fa-spinner' );
            $('#add_btn').prop( 'disabled', 'true' );

            $('#loader_table').removeAttr( 'style' );
            $('#fuel_table').css( 'display', 'none');
            $.ajax({
                    url:"{{ route('abastecimento.addToOrdens') }}",
                    type:"GET",
                    data:{viatura:viatura, rotas:rotas, quantidade:quantidade, combustivel_estimativa:combustivel_estimativa, distancia_estimada:distancia_estimada, distancia_calculada:distancia_calculada, periodo:periodo, justificacao:justificacao},
                    success: function(data) {
                        if (data == 'duplicate') {
                            matricula = document.getElementById('viatura').options[document.getElementById('viatura').selectedIndex].text
                            notifyError('Ordem', 'A viatura '+matricula+' já foi adicionada a lista de ordens!')
                        } else {
                            notifySuccess('Ordem', 'Adicionada a lista!')
                            $('#orders').html(data)
                        }

                        $('#loader_table').css( 'display', 'none');
                        $('#fuel_table').removeAttr( 'style' );

                        $('#loader_button').removeAttr( 'class' );
                        $('#loader_button').attr( 'class', 'fa fa-plus' );
                        document.getElementById('add_btn').removeAttribute('disabled');
                    },
                    complete: function(data){

                        $("#viatura").val('').trigger('change');
                        $("#rota").val('').trigger('change');
                        $("#periodo").val('').trigger('change');
                        document.getElementById('quantidade').value = ''
                        document.getElementById('distancia_estimada').value = ''
                        document.getElementById('distancia_calculada').value = ''
                        document.getElementById('periodo').value = ''
                        document.getElementById('justificacao').value = ''

                    }
            });
        }
    }

function removeFromOrdens(id, r) {
        document.getElementById("basic-1").deleteRow(r.rowIndex);

        $.ajax({
                url:"{{ route('abastecimento.removeFromOrdens') }}",
                type:"GET",
                data:{id:id},
                success: function(data) {
                    notifySuccess('Ordem', 'Removida com sucesso!')
                }
        });
}
</script>
@endsection
