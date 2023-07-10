@extends('layouts.simple.master')
@section('title', 'Inventário')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Inventário</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Inventário</li>
    <li class="breadcrumb-item active">Entrada</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <h5>Entrada</h5>
               <span> <span style="color: red">*</span> campo obrigatório</span>
            </div>
            <form class="theme-form mega-form" autocomplete="off" action="{{ route('inventario.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    {{-- <h6>Informação básica</h6>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Quantidade (Litros) <span style="color: red">*</span></label>
                               <input class="form-control digits" type="number" name="quantidade" id="quantidade" min="1" placeholder="XY litros" oninput="javascript:updateDistance(this.value)" onchange="javascript:updateDistance(this.value)">
                               @error('quantidade') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                    <hr> --}}
                    <div class="row m-b-10">
                        <div class="col-md-10">
                            <h6>Peça</h6>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success f-right" onclick="javascript:addToEntradas()" id="add_btn"><i class="fa fa-plus" id="loader_button"></i> Adicionar</button>
                        </div>
                    </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="col-form-label">Peças <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="peca" id="peca" onchange="javascript:getViaturaInfo(this.value)">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($pecas as $peca)
                                        <option value="{{$peca->id}}" {{(old('peca') == $peca->id) ? 'selected' : ''}}>{{$peca->designacao}}</option>
                                    @endforeach
                                </select>
                                @error('peca') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Quantidade (unidades) <span style="color: red">*</span></label>
                               <input class="form-control digits" type="number" name="quantidade" id="quantidade" min="1" placeholder="Digite quantas unidades dará entrada">
                               @error('quantidade') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                               <label class="col-form-label">Preço (meticais) <span style="color: red">*</span></label>
                               <input class="form-control digits" type="number" name="preco" id="preco" min="1" placeholder="Digite o preço da peça">
                               @error('preco') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="col'md-12">
                               <div class="mb-3 mb-0">
                                  <label for="descricao">Observações <span style="color: red">*</span></label>
                                  <textarea class="form-control" name="observacao" id="observacao" rows="3">{{old('observacao')}}</textarea>
                               </div>
                               @error('observacao') <span style="color: red">{{$message}}.</span> @enderror
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
                                              <th>Designação</th>
                                              <th>Quantidade (unidades)</th>
                                              <th>Preço (meticais)</th>
                                              <th>Total (meticais)</th>
                                              <th>Opcções</th>
                                          </tr>
                                    </thead>
                                    <tbody id="pecas">
                                        @include('inventario.components.pecas-table')
                                    </tbody>
                                </table>
                             </div>

                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('inventario.list') }}" class="btn btn-danger">Cancelar</a>
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
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

<script>

    function addToEntradas() {
        peca = document.getElementById('peca').value
        quantidade = document.getElementById('quantidade').value
        preco = document.getElementById('preco').value
        observacao = document.getElementById('observacao').value

        if (!peca) {
            notifyError('Peça', 'Não pode adicionar uma entrada sem antes escolher uma peça!')
        } else if (!quantidade) {
            notifyError('Quantidade', 'Não pode adicionar uma entrada sem antes digitar a quantidade de unidades!')
        // } else if (!periodo) {
        //     notifyError('Viatura', 'Não pode adicionar uma ordem sem antes escolher o período!')
        } else {
            $('#loader_button').removeAttr( 'class' );
            $('#loader_button').attr( 'class', 'fa fa-spin fa-spinner' );
            $('#add_btn').prop( 'disabled', 'true' );

            $('#loader_table').removeAttr( 'style' );
            $('#fuel_table').css( 'display', 'none');
            $.ajax({
                    url:"{{ route('inventario.addToEntradas') }}",
                    type:"GET",
                    data:{peca:peca, quantidade:quantidade, preco:preco, observacao:observacao},
                    success: function(data) {
                        if (data == 'duplicate') {
                            peca = document.getElementById('peca').options[document.getElementById('peca').selectedIndex].text
                            notifyError('Entrada', 'A peça '+peca+' já foi adicionada a lista de entradas!')
                        } else {
                            notifySuccess('Entrada', 'Adicionada a lista!')
                            $('#pecas').html(data)
                        }

                        $('#loader_table').css( 'display', 'none');
                        $('#fuel_table').removeAttr( 'style' );

                        $('#loader_button').removeAttr( 'class' );
                        $('#loader_button').attr( 'class', 'fa fa-plus' );
                        document.getElementById('add_btn').removeAttribute('disabled');
                    },
                    complete: function(data){

                        $("#pecas").val('').trigger('change');
                        document.getElementById('quantidade').value = ''
                        document.getElementById('preco').value = ''
                        document.getElementById('observacao').value = ''

                    }
            });
        }
    }

function removeFromEntradas(id, r) {
        document.getElementById("basic-1").deleteRow(r.rowIndex);

        $.ajax({
                url:"{{ route('inventario.removeFromEntradas') }}",
                type:"GET",
                data:{id:id},
                success: function(data) {
                    notifySuccess('Peça', 'Removida com sucesso!')
                }
        });
}
</script>
@endsection
