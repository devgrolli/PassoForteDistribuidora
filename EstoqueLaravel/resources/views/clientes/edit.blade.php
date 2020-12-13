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
          <h3><strong>Editando: </strong>{{ $cliente->nome }}</h3>
      </div>
  
      <div class="card-body">
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
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
            <a href="{{ route('clientes', []) }}" class="btn btn-danger">Cancelar</a>
          </div>
        {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
      </div>
    </div>
@stop