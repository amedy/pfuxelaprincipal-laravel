@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo" href=""><img class="img-fluid for-light" style="width: 100px" src="{{asset('assets/images/logo/login.png')}}" alt="Pfuxela"><img class="img-fluid for-dark" style="width: 100px" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="Pfuxela"></a></div>
               <div class="login-main">
                  <form class="theme-form needs-validation @error('email') was-validated @enderror" autocomplete="off" action="{{ route('login.auth') }}" method="POST">
                     @csrf
                     <h4>Bem Vindo(a)</h4>
                     <p>Digite as suas credenciais para fazer o login</p>
                     <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input class="form-control" type="email" required="" name="email" value="" placeholder="Digite o seu email">
                        <div class="invalid-tooltip">@error('email') {{$message}} @enderror</div>
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Senha</label>
                        <input class="form-control" type="password" name="senha" required="" placeholder="Digite a sua senha">
                        {{-- <div class="show-hide"><span class="show"></span></div> --}}
                     </div>
                     <div class="form-group mb-0">
                        <div class="checkbox p-0">
                           <p></p>
                           {{-- <input id="checkbox1" type="checkbox"> --}}
                           {{-- <label class="text-muted" for="checkbox1">Remember</label> --}}
                        </div>
                        <a class="link" href="{{ route('forget-password') }}">Esqueceu a senha?</a>
                        <button class="btn btn-primary btn-block" type="submit">Entrar</button>
                     </div>
                     {{-- <h6 class="text-muted mt-4 or">Or Sign in with</h6>
                     <div class="social mt-4">
                        <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn </a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="txt-fb" data-feather="facebook"></i>facebook</a></div>
                     </div>
                     <p class="mt-4 mb-0">Don't have account?<a class="ms-2" href="{{  route('sign-up') }}">Create Account</a></p> --}}
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection
