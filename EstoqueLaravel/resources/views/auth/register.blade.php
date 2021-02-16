{{-- <head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    <!--===============================================================================================-->
</head>

<body>
        
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-90">
                <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('register') }}">
                    @csrf
                    <span class="login100-form-title p-b-51">
                        Cadastro
                    </span>    

                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" placeholder="Nome" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <span class="focus-input100"></span>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert" style="color: rgb(218, 1, 1)">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Insira seu e-mail">
                        <input class="input100" type="text" placeholder="E-mail"  @error('email') @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span class="focus-input100"></span>
                        
                    </div>
                    @error('email')
                            <span class="invalid-feedback" role="alert" style="color: rgb(218, 1, 1)">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Insira seu e-mail">
                        <input class="input100" id="password" type="password" placeholder="Senha" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        <span class="focus-input100"></span>
                        
                    </div>
                    @error('email')
                            <span class="invalid-feedback" role="alert" style="color: rgb(218, 1, 1)">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Insira seu e-mail">
                        <input id="password-confirm" type="password" class="input100" id="password" placeholder="Confirmar senha" name="password_confirmation" required autocomplete="new-password">
                        <span class="focus-input100"></span>
                        
                    </div>
                    @error('email')
                            <span class="invalid-feedback" role="alert" style="color: rgb(218, 1, 1)">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn" type="submit"> {{ __('Cadastrar') }}</button>
                        <a href="{{ route('login') }}" class="cadastro100-form-btn" >Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

    </body>
</html> --}}