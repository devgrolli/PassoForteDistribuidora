@extends('layouts.default')

@section('content')
  <div class="card">
    <div class="card-header" style="background: rgb(52, 58, 64)">
      <h3 style="color:rgb(255, 255, 255)"><strong>Editando usuário</strong></h3>
    </div>

    <div class="card-body">   
      {!! Form::open(['route'=> ["usuarios.update", 'id'=>$usuario->id], 'method'=>'put']) !!}
        <div class="form-group">
          {!! Form::label('nome', 'Nome') !!}
          {!! Form::text('nome', $usuario->name, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'E-mail') !!}
            {!! Form::text('email', $usuario->email, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('password', 'Senha') !!}
          {!! Form::text('password', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Editar', ['class'=>'btn btn-padrao1']) !!}
          <a href="{{ route('usuarios', []) }}" class="btn btn-padrao2">Cancelar</a>
        </div>
          
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
  @include('sweetalert::alert')
@stop