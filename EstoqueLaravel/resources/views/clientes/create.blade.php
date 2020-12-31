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
        <h3><strong>Cadastro Saída de Produtos</strong></h3>
    </div>

    <div class="card-body">
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
            {!! Form::text('telefone', null, ['class'=>'form-control', 'id'=>'celular', 'required']) !!}
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