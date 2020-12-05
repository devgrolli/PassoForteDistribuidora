@extends('adminlte::page')

@section('content')
    <h3> Editando cliente> {{ $cliente->nome }} </h3>

    @if($errors->any()) <!-- existe algum erro neste array? -->
      <ul class="alert alert-danger"> 
        @foreach($errors-all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    {!! Form::open(['route'=> ["clientes.update", 'id'=>$cliente->id], 'method'=>'put']) !!}

        <div class="form-group">
          {!! Form::label('nome', 'Nome') !!}
          {!! Form::text('nome', $cliente->nome, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('telefone', 'Telefone') !!}
            {!! Form::text('telefone', $cliente->telefone, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('email', 'E-mail') !!}
          {!! Form::text('email', $cliente->email, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('descricao', 'Descrição') !!}
            {!! Form::text('descricao', $cliente->descricao, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('tipo_cliente_id', 'Tipo de Cliente') !!}
          {!! Form::select('tipo_cliente_id', \App\TipoCliente::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                $cliente->tipo_cliente_id, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar', ['class'=>'btn btn-success']) !!}
          <a href="{{ route('clientes', []) }}" class="btn btn-danger">Voltar</a>
        </div>
        
    {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
@stop