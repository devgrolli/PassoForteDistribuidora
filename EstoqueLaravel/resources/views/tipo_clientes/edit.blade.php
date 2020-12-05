@extends('adminlte::page')

@section('content')
    <h3> Editando tipo de Cliente</h3>

    @if($errors->any()) <!-- existe algum erro neste array? -->
    <ul class="alert alert-danger"> 
      @foreach($errors-all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
   @endif
    {!! Form::open(['route'=>'tipo_cliente.store']) !!}
        <div class="form-group">
          {!! Form::label('nome', 'Nome') !!}
          {!! Form::text('nome', $tipo_cliente->nome, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('descricao', 'Descrição') !!}
          {!! Form::text('descricao', $tipo_cliente->descricao, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar campos', ['class'=>'btn btn-success']) !!}
          <a href="{{ route('tipo_cliente', []) }}" class="btn btn-danger">Voltar</a>
        </div>

    {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
@stop