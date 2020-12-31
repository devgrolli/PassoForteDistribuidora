@extends('layouts.default')

@section('content')
    @if($errors->any()) <!-- existe algum erro neste array? -->
    <ul class="alert alert-danger"> 
      @foreach($errors-all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
   @endif

  <div class="card">
    <div class="card-header" style="background: lightgrey">
        <h3><strong>Tipos de Cliente</strong></h3>
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
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
          <a href="{{ route('tipo_clientes', []) }}" class="btn btn-danger">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 

    </div>
  </div>
@stop