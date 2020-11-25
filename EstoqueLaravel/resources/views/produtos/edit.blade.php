@extends('adminlte::page')

@section('content')
    <h3> Editando Produto> {{ $produto->nome }} </h3>

    @if($errors->any()) <!-- existe algum erro neste array? -->
      <ul class="alert alert-danger"> 
        @foreach($errors-all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    {!! Form::open(['route'=> ["produtos.update", 'id'=>$produto->id], 'method'=>'put']) !!}

        <div class="form-group">
          {!! Form::label('nome', 'Nome') !!}
          {!! Form::text('nome', $produto->nome, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('preco_un', 'Preço unitário') !!}
          {!! Form::text('preco_un', $produto->preco_un, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::text('quantidade', $produto->quantidade, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('marca', 'Marca') !!}
            {!! Form::text('marca', $produto->marca, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar', ['class'=>'btn btn-success']) !!}
          <a href="{{ route('produtos', []) }}" class="btn btn-danger">Voltar</a>
        </div>
        
    {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
@stop