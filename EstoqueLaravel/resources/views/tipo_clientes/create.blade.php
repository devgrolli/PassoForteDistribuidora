@extends('layouts.default')
@section('content')
  <div class="card">
    <div class="card-header" style="background: rgb(52, 58, 64)">
      <h3 style="color:rgb(255, 255, 255)"><strong>Tipos de Cliente</strong></h3>
    </div>

    <div class="card-body">
      {!! Form::open(['route'=>'tipo_clientes.store']) !!}
        <div class="form-group">
          {!! Form::label('nome', 'Nome') !!}
          {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('descricao', 'Descrição') !!}
          {!! Form::text('descricao', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-padrao1']) !!}
          <a href="{{ route('tipo_clientes', []) }}" class="btn btn-padrao2">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
  @include('sweetalert::alert')
@stop