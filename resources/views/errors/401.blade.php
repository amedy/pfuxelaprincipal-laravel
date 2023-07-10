@extends('layouts.errors.master')
@section('title', 'Error 401')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
<div class="page-wrapper compact-wrapper" id="pageWrapper">
<!-- error-401 start-->
<div class="error-wrapper">
  <div class="container"><img class="img-100" src="{{asset('assets/images/other-images/sad.png')}}" alt="">
    <div class="error-heading">
      <h2 class="headline font-danger">401</h2>
    </div>
    <div class="col-md-8 offset-md-2">
      <p class="sub-content">Ocorreu um erro inesperado. <br> Por favor tente novamente, e se o erro persistir contacte o administrador do sistema.</p>
    </div>
    <div><a class="btn btn-primary btn-lg" href="{{route('dashboard')}}">Voltar a Dashboard</a></div>
  </div>
</div>
<!-- error-401 end-->
</div>
@endsection

@section('script')

@endsection
