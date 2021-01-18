@extends('adminlte::page')

@section('content')
   @include('layouts.alerts')
   <div class="card">
    <div class="card-header" style="background: rgb(52, 58, 64)">
        <h3 style="color:rgb(255, 255, 255)"><strong>Cadastro Produtos</strong></h3>
    </div>

    <div class="card-body">
      {!! Form::open(['route'=>'produtos.store']) !!}
      <div class="form-row">
          <div class="col">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', null, ['class'=>'form-control']) !!}
          </div>
          <div class="col">
            {!! Form::label('marca', 'Marca') !!}
            {!! Form::text('marca', null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>
          
        <div class="form-row">
          <div class="col">
            {!! Form::label('categorias_id', 'Categorias') !!}
            {!! Form::select('categorias_id', \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                  null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>
        <br>
        <div class="form-group">
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-padrao1']) !!}
          <a href="{{ route('produtos', []) }}" class="btn btn-padrao2">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
@stop