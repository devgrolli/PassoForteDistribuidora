@extends('adminlte::page')

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
          <h3>Cadastro Produtos</h3>
      </div>
  
      <div class="card-body">
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
              {!! Form::label('quantidade', 'Estoque') !!}
              {!! Form::text('quantidade', $produto->quantidade, ['class'=>'form-control', 'disabled']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('marca', 'Marca') !!}
              {!! Form::text('marca', $produto->marca, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
            <a href="{{ route('produtos', []) }}" class="btn btn-danger">Cancelar</a>
          </div>
        {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
      </div>
    </div>
@stop