@extends('layouts.default')

@section('content')
  @include('layouts.alerts')
   <div class="card">
    <div class="card-header" style="background: rgb(52, 58, 64)">
      <h3 style="color:rgb(255, 255, 255)"><strong>Cadastro de clientes</strong></h3>
    </div>

    <div class="card-body needs-validation" novalidate>
      {!! Form::open(['route'=>'clientes.store']) !!}

        <div class="form-row">
          <div class="col">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
          
          </div>
        
          <div class="col">
            {!! Form::label('email', 'E-mail') !!}
            {!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('telefone', 'Telefone') !!}
            {!! Form::text('telefone', null, ['class'=>'form-control', 'id'=>'telefone', 'maxlength' => 15, 'required']) !!}
          </div>
        </div>

        <div class="form-group">
            {!! Form::label('descricao', 'Descrição') !!}
            {!! Form::textarea('descricao', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('tipo_cliente_id', 'Tipo do Cliente') !!}
          {!! Form::select('tipo_cliente_id', \App\TipoCliente::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
          <a href="{{ route('clientes', []) }}" class="btn btn-danger">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
@stop

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
  <script src="js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript" /></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>
      function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)
      }
      
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
      }

      function mtel(v){
          v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
          v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
          v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
          return v;
      }

      function id( el ){
        return document.getElementById( el );
      }

      window.onload = function(){
        id('telefone').onkeyup = function(){
          mascara( this, mtel );
        }
      }

  </script>