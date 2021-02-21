@extends('layouts.default')

@section('content')

<link rel="stylesheet" type="text/css" href="../css/default-template.css">
<div id="div_create">
    <div class="card">
        <div class="card-header">
            <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                <h1 class="text-create"><strong>Cadastro cliente </strong></h1>
            </div>
        </div>

        <div class="card-body" id="card_crud">
        {!! Form::open(['route'=>'clientes.store']) !!}

        <div class="form-row">
          <div class="form-group col-md-6">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
          
          </div>
          <div class="form-group col-md-4">
            {!! Form::label('email', 'E-mail') !!}
            {!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="form-group col-md-2">
            {!! Form::label('telefone', 'Telefone') !!}
            {!! Form::text('telefone', null, ['class'=>'form-control', 'id'=>'telefone', 'maxlength' => 15, 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('endereco', 'Endereço') !!}
            {!! Form::text('endereco', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('tipo_cliente_id', 'Tipo do Cliente') !!}
            {!! Form::select('tipo_cliente_id', \App\TipoCliente::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                  null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('descricao', 'Descrição') !!}
            {!! Form::textarea('descricao', null, ['class'=>'form-control']) !!}
          </div>
        </div><br>
        <div class="form-group">
          {!! Form::button('Cadastrar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
          <a href="{{ route('clientes', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
</div>
  @include('sweetalert::alert')
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