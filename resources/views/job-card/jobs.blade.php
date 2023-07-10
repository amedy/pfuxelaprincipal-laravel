@extends('layouts.simple.master')
@section('title', 'Job Card')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Job Card</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Job Card</li>
    <li class="breadcrumb-item active">Trabalhos feitos</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Trabalhos feitos</h5>
                    <span> <span style="color: red">*</span> campo obrigatório</span>
                </div>
                <form class="theme-form mega-form" autocomplete="off" action="{{ route('job-card.jobs.store', Crypt::encrypt($job->id)) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row m-b-10">
                            <div class="col-md-10">
                                <h6>Trabalho</h6>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success f-right" onclick="javascript:addToJobs()" id="add_btn"><i class="fa fa-plus" id="loader_button"></i> Adicionar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 mb-0">
                                    <label for="descricao">Descrição do trabalho feito <span style="color: red">*</span></label>
                                    <textarea class="form-control" name="descricao_trabalho" id="descricao_trabalho" rows="5">{{old('descricao_trabalho')}}</textarea>
                                </div>
                                @error('descricao_trabalho') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Técnico (1) <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="tecnico_1" id="tecnico_1">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($tecnicos as $tecnico)
                                        <option value="{{$tecnico->id}}" {{(old('tecnico_1') == $tecnico->id) ? 'selected' : ''}}>{{$tecnico->nome . ' ' . $tecnico->apelido}}</option>
                                    @endforeach
                                </select>
                                @error('tecnico_1') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                               <label class="col-form-label">Data e hora de início (1) <span style="color: red">*</span></label>
                               <div class="input-group">
                                  <input class="form-control digits" type="datetime-local" min="{{date('Y-m-d').'T'.date('00:00')}}" max="{{date('Y-m-d').'T'.date('H:i')}}" name="data_hora_inicio_1" id="data_hora_inicio_1" value="{{old('data_hora_inicio_1')}}">
                               </div>
                               @error('data_hora_inicio_1') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                               <label class="col-form-label">Data e hora de fim (1) <span style="color: red">*</span></label>
                               <div class="input-group">
                                  <input class="form-control digits" type="datetime-local" min="{{date('Y-m-d').'T'.date('00:00')}}" max="{{date('Y-m-d').'T'.date('H:i')}}" name="data_hora_fim_1" id="data_hora_fim_1" value="{{old('data_hora_fim_1')}}">
                               </div>
                               @error('data_hora_fim_1') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="col-form-label">Técnico (2) <span style="color: red">*</span></label>
                                <select class="js-example-basic-single col-sm-12" name="tecnico_2" id="tecnico_2">
                                    <option value="">Escolha uma opcção</option>
                                    @foreach ($tecnicos as $tecnico)
                                        <option value="{{$tecnico->id}}" {{(old('tecnico') == $tecnico->id) ? 'selected' : ''}}>{{$tecnico->nome . ' ' . $tecnico->apelido}}</option>
                                    @endforeach
                                </select>
                                @error('tecnico_2') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                               <label class="col-form-label">Data e hora de início (2) <span style="color: red">*</span></label>
                               <div class="input-group">
                                  <input class="form-control digits" type="datetime-local" min="{{date('Y-m-d').'T'.date('00:00')}}" max="{{date('Y-m-d').'T'.date('H:i')}}" name="data_hora_inicio_2" id="data_hora_inicio_2" value="{{old('data_hora_inicio_2')}}">
                               </div>
                               @error('data_hora_inicio_2') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                               <label class="col-form-label">Data e hora de fim (2) <span style="color: red">*</span></label>
                               <div class="input-group">
                                  <input class="form-control digits" type="datetime-local" min="{{date('Y-m-d').'T'.date('00:00')}}" max="{{date('Y-m-d').'T'.date('H:i')}}" name="data_hora_fim_2" id="data_hora_fim_2" value="{{old('data_hora_fim_2')}}">
                               </div>
                               @error('data_hora_fim_2') <span style="color: red">{{$message}}.</span> @enderror
                            </div>
                        </div>
                        <hr>
                        <h6>Lista de trabalhos</h6>
                        <div class="col-md-12" style="display: none" id="loader_table">
                            <div class="loader-box">
                                <div class="loader-30"></div>
                            </div>
                        </div>
                        <div class="row" id="jobs_table">
                            <div class="table-responsive">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Descrição</th>
                                            <th colspan="3" style="text-align: center">Técnico (1)</th>
                                            <th colspan="3" style="text-align: center">Técnico (2)</th>
                                            <th rowspan="2">Opcções</th>
                                        </tr>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Início</th>
                                            <th>Fim</th>
                                            <th>Nome</th>
                                            <th>Início</th>
                                            <th>Fim</th>
                                        </tr>
                                    </thead>
                                    <tbody id="jobs">
                                        @include('job-card.components.table')
                                    </tbody>
                                </table>
                             </div>

                        </div>
                    </div>
                    <div class="card-footer">
                            <a href="{{ route('job-card.list') }}" class="btn btn-danger">Cancelar</a>
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
    function addToJobs() {
        descricao_trabalho = document.getElementById('descricao_trabalho').value
        tecnico_1 = document.getElementById('tecnico_1').value
        data_hora_inicio_1 = document.getElementById('data_hora_inicio_1').value
        data_hora_fim_1 = document.getElementById('data_hora_fim_1').value
        tecnico_2 = document.getElementById('tecnico_2').value
        data_hora_inicio_2 = document.getElementById('data_hora_inicio_2').value
        data_hora_fim_2 = document.getElementById('data_hora_fim_2').value

        if (!descricao_trabalho) {
            notifyError('Descrição', 'Não pode adicionar um trabalho sem antes digitar uma descrição!')
        } else if (!tecnico_1) {
            notifyError('Técnico', 'Não pode adicionar um trabalho sem antes escolher um técnico!')
        } else if (!data_hora_inicio_1) {
            notifyError('Data e hora início (1)', 'Não pode adicionar um trabalho sem antes escolher a data e hora de início (1)!')
        } else if (!data_hora_fim_1) {
            notifyError('Data e hora fim (1)', 'Não pode adicionar um trabalho sem antes escolher a data e hora de fim (1)!')
        } else {
            $('#loader_button').removeAttr( 'class' );
            $('#loader_button').attr( 'class', 'fa fa-spin fa-spinner' );
            $('#add_btn').prop( 'disabled', 'true' );

            $('#loader_table').removeAttr( 'style' );
            $('#jobs_table').css( 'display', 'none');
            $.ajax({
                    url:"{{ route('job-card.addToJobs') }}",
                    type:"GET",
                    data:{descricao_trabalho:descricao_trabalho, tecnico_1:tecnico_1, data_hora_inicio_1:data_hora_inicio_1, data_hora_fim_1:data_hora_fim_1, tecnico_2:tecnico_2, data_hora_inicio_2:data_hora_inicio_2, data_hora_fim_2:data_hora_fim_2},
                    success: function(data) {
                        if (data == 'duplicate') {
                            tecnico = document.getElementById('tecnico_1').options[document.getElementById('tecnico_1').selectedIndex].text
                            notifyError('Trabalho', 'O técnico '+tecnico+' já foi adicionado a lista de trabalhos!')
                        } else {
                            notifySuccess('Trabalho', 'Adicionado a lista!')
                            $('#jobs').html(data)
                        }

                        $('#loader_table').css( 'display', 'none');
                        $('#jobs_table').removeAttr( 'style' );

                        $('#loader_button').removeAttr( 'class' );
                        $('#loader_button').attr( 'class', 'fa fa-plus' );
                        document.getElementById('add_btn').removeAttribute('disabled');
                    },
                    complete: function(data){

                        document.getElementById('descricao_trabalho').value = ''
                        $("#tecnico_1").val('').trigger('change');
                        $("#tecnico_2").val('').trigger('change');
                        document.getElementById('data_hora_inicio_1').value = ''
                        document.getElementById('data_hora_fim_1').value = ''
                        document.getElementById('data_hora_inicio_2').value = ''
                        document.getElementById('data_hora_fim_2').value = ''

                    }
            });
        }
    }

    function removeFromJobs(id, r) {
            document.getElementById("basic-1").deleteRow(r.rowIndex);

            $.ajax({
                    url:"{{ route('job-card.removeFromJobs') }}",
                    type:"GET",
                    data:{id:id},
                    success: function(data) {
                        notifySuccess('Trabalho', 'Removido com sucesso!')
                    }
            });
    }
</script>
@endsection
