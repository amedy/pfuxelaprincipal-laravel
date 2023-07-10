@extends('layouts.simple.master')
@section('title', 'Abastecimento')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Abastecimento</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Abastecimento</li>
    <li class="breadcrumb-item">Ordem</li>
    <li class="breadcrumb-item active">Terminar ordem</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Terminar ordem</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('abastecimento.store') }}" method="POST">
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
                        </div>
                    <hr>
                    <div class="row m-b-10">
                        <div class="col-md-10">
                            <h6>Ordem</h6>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success f-right" onclick="javascript:addToOrdens()"><i class="fa fa-plus"></i> Adicionar</button>
                        </div>
                    </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Viaturas <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="viatura" id="viatura" onchange="javascript:getFuel(this.value)">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($viaturas as $viatura)
                                        <option value="{{$viatura->id}}" {{(old('viatura') == $viatura->id) ? 'selected' : ''}}>{{$viatura->matricula}}</option>
                                    @endforeach
                                </select>
                                <span>Combustível actual: "<a class="font-primary" id="fuel">--</a>" Litros</span>
                                @error('viatura') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Rotas <span style="color: red">*</span></label>
                                <select class="js-example-basic-multiple col-sm-12" name="rota[]" id="rota" multiple="multiple">
                                    @foreach ($rotas as $rota)
                                        <option value="{{$rota->id}}">{{$rota->name}}</option>
                                    @endforeach
                                </select>
                                @error('rota') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                               <label class="col-form-label">Quantidade (Litros) <span style="color: red">*</span></label>
                               <input class="form-control digits" type="number" name="quantidade" id="quantidade" min="1" value="{{(old('quantidade')) ? old('quantidade') : 1}}">
                               @error('quantidade') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                               <label class="col-form-label">Distância (Km) <span style="color: red">*</span></label>
                               <input class="form-control digits" type="number" name="distancia" id="distancia" min="1" value="{{(old('distancia')) ? old('distancia') : 1}}">
                               @error('distancia') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                                <label class="col-form-label">Hora de saída <span style="color: red">*</span></label>
								<div class="input-group">
									<input class="form-control digits" type="time" name="hora_saida" id="hora_saida" min="{{date('Y-m-d')}}" value="{{old('data_emissao')}}">
								</div>
                                @error('hora_saida') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="col">
                               <div class="mb-3 mb-0">
                                  <label for="descricao">Justificação <span style="color: red">*</span></label>
                                  <textarea class="form-control" name="justificacao" id="justificacao" rows="3">{{old('justificacao')}}</textarea>
                               </div>
                               @error('justificacao') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                    <hr class="mt-4 mb-4">
                    <h6>Adicionadas</h6>

                        <div class="col-md-12" style="display: none" id="loader_table">
                            <div class="loader-box">
                                <div class="loader-30"></div>
                            </div>
                        </div>
                        <div class="row" id="fuel_table">
                            <div class="table-responsive">
                                <table class="display" id="basic-1">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Matrícula</th>
                                              <th>Odômetro</th>
                                              <th>Quantidade (Litros)</th>
                                              <th>Preço</th>
                                              <th>Rotas</th>
                                              <th>Subtotal</th>
                                              <th>Opcções</th>
                                          </tr>
                                    </thead>
                                    <tbody id="orders">
                                        @include('abastecimento.components.order-table')
                                    </tbody>
                                </table>
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
    function getFuel(id) {
        if (id) {
            $.ajax({
                    url:"{{ route('viatura.getFuel') }}",
                    type:"GET",
                    data:{id:id},
                    success: function(data) {

                        document.getElementById('fuel').innerHTML = data
                    }
            });
        } else {
            document.getElementById('fuel').innerHTML = '--'
        }
    }

    function addToOrdens() {
        viatura = document.getElementById('viatura').value
        rotas = $('#rota').val()
        quantidade = document.getElementById('quantidade').value
        distancia = document.getElementById('distancia').value
        hora_saida = document.getElementById('hora_saida').value
        justificacao = document.getElementById('justificacao').value

            $('#loader_table').removeAttr( 'style' );
            $('#fuel_table').css( 'display', 'none');
            $.ajax({
                    url:"{{ route('abastecimento.addToOrdens') }}",
                    type:"GET",
                    data:{viatura:viatura, rotas:rotas, quantidade:quantidade, distancia:distancia, hora_saida:hora_saida, justificacao:justificacao},
                    success: function(data) {
                        if (data == 'duplicate') {
                            matricula = document.getElementById('viatura').options[document.getElementById('viatura').selectedIndex].text
                            notifyError('Ordem', 'A viatura '+matricula+' já foi adicionada a lista de ordens!')
                        } else {
                            notifySuccess('Ordem', 'Adicionada com sucesso!')
                            $('#orders').html(data)
                        }

                        $('#loader_table').css( 'display', 'none');
                        $('#fuel_table').removeAttr( 'style' );
                    },
                    complete: function(data){

                        $("#viatura").val('').trigger('change');
                        $("#rota").val('').trigger('change');
                        // rotas = $('#rota').val('')
                        quantidade = document.getElementById('quantidade').value = 1
                        distancia = document.getElementById('distancia').value = 1
                        hora_saida = document.getElementById('hora_saida').value = ''
                        justificacao = document.getElementById('justificacao').value = ''

                    }
            });
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
