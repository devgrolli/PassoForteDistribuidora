@extends('adminlte::page')

@section('content')
    <h3> Novo Cliente</h3>

    @if($errors->any()) <!-- existe algum erro neste array? -->
    <ul class="alert alert-danger"> 
      @foreach($errors-all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
   @endif
    {!! Form::open(['route'=>'clientes.store']) !!}
        <div class="form-group">
          {!! Form::label('nome', 'Nome') !!}
          {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
        </div>
        
        <div class="form-group">
          {!! Form::label('email', 'E-mail') !!}
          {!! Form::text('email', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('telefone', 'Telefone') !!}
            {!! Form::text('telefone', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('descricao', 'Descrição') !!}
            {!! Form::text('descricao', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('tipo_cliente_id', 'Tipo do Cliente') !!}
          {!! Form::select('tipo_cliente_id', \App\TipoCliente::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar campos', ['class'=>'btn btn-success']) !!}
          <a href="{{ route('clientes', []) }}" class="btn btn-danger">Voltar</a>
        </div>
    {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
@stop