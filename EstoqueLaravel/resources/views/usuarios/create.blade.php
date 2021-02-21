@extends('layouts.default')

@section('content')

    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div class="card">
        <div class="card-header" style="background: rgb(52, 58, 64)">
            <h3 style="color:rgb(255, 255, 255)"><strong>Cadastro novo usuário</strong></h3>
        </div>

        <div class="card-body needs-validation" novalidate>
            {!! Form::open(['route' => 'usuarios.store']) !!}

            <div class="form-row">
                <div class="col">
                    {!! Form::label('name', 'Nome') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}

                </div>
                <div class="col">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="col">
                    {!! Form::label('password', 'Senha') !!}
                    {!! Form::text('password', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <br>
            <div class="form-group">
                {!! Form::submit('Cadastrar', ['class' => 'btn btn-padrao1']) !!}
                <a href="{{ route('usuarios', []) }}" class="btn btn-padrao2">Cancelar</a>
            </div>
            {!! Form::close() !!}
            <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
        </div>
    </div>
    @include('sweetalert::alert')
@stop

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript" />
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    function mtel(v) {
        v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
        v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
        return v;
    }

    function id(el) {
        return document.getElementById(el);
    }

    window.onload = function() {
        id('telefone').onkeyup = function() {
            mascara(this, mtel);
        }
    }

</script>
