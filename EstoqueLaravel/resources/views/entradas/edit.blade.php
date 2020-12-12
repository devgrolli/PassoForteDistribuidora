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
        <h3>Editando Entrada de Produtos</h3>
    </div>

    <div class="card-body">
      {!! Form::open(['route'=> ["entradas.update", 'id'=>$entrada->id], 'method'=>'put']) !!}
        <div class="form-group">
          {!! Form::label('produto_id', 'Produto') !!}
          {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                $entrada->produto_id, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::text('quantidade', $entrada->quantidade, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('preco_un', 'Preço Unitário') !!}
            {!! Form::text('preco_un', $entrada->preco_un, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('fornecedor_id', 'Fornecedor') !!}
            {!! Form::select('fornecedor_id', \App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(), 
                                                $entrada->fornecedor_id, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('tipo_entrada_id', 'Tipo de entrada') !!}
            {!! Form::select('tipo_entrada_id', \App\TipoEntrada::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                  $entrada->tipo_entrada_id, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('data_entrada', 'Data de Entrada') !!}
          {!! Form::date('data_entrada', $entrada->data_entrada, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('observacoes', 'Observações') !!}
          {!! Form::textarea('observacoes', $entrada->observacoes, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar', ['class'=>'btn btn-success']) !!}
          <a href="{{ route('entradas', []) }}" class="btn btn-danger">Voltar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
    </div>
  </div>

@stop