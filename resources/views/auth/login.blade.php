<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/login.css') }}" rel="stylesheet"> 
    </head>
    <body>
        
        <div class="limiter">
            <div class="container-login100" id="div-login">
                <div class="wrap-login100 p-t-50 p-b-90">
                    <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}">
                        @csrf
                        <span class="login100-form-title p-b-51">
                            Login
                        </span>    
                        
                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Insira seu e-mail">
                            <input id="email" class="input100" type="text" placeholder="E-mail"  @error('email') @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="focus-input100"></span>
                            
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="color: rgb(218, 1, 1)">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        
                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Insira a sua senha">
                            <input id="senha" class="input100" type="password" placeholder="Senha" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <span class="focus-input100"></span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="color: rgb(218, 1, 1)">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        {{-- <div class="flex-sb-m w-full p-t-3 p-b-24">    
                            @if (Route::has('password.request'))
                                <div>
                                    <a class="txt1" href="{{ route('password.request') }}">
                                        {{ __('Esqueceu a senha?') }}
                                    </a>
                                </div>
                            @endif
                        </div> --}}
    
                        <div class="container-login100-form-btn m-t-17">
                            <button id="btn-logar" class="login100-form-btn" type="submit"> {{ __('Entrar') }}</button>
                            @if (Route::has('login'))
                                <div class="top-right links">
                                {{-- @auth --}}
                                    <a href="{{ url('') }}" id="btn-voltar" class="cadastro100-form-btn" >voltar</a>
                                {{-- @else 
                                     @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="cadastro100-form-btn" >Cadastre-se</a>
                                    @endif
                                @endauth --}}
                                </div>
                             @endif 
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    
        <div id="dropDownSelect1"></div>
    </body>
</html>