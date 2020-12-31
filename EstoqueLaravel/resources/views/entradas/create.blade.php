@extends('layouts.default')

@section('content')
    @include('layouts.alerts')
    <div class="card">
      <div class="card-header" style="background: lightgrey">
          <h3><strong>Cadastro Entrada de Produtos</strong></h3>
      </div>
  
      <div class="card-body">
        {!! Form::open(['route'=>'entradas.store']) !!}
          <div class="form-group">
            {!! Form::label('produto_id', 'Produto') !!}
            {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                  null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="form-row">
            <div class="col">
              {!! Form::label('quantidade', 'Quantidade') !!}
              {!! Form::text('quantidade', null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('preco_un', 'Preço Unitário') !!}
              {!! Form::text('preco_un', null, ['class'=>'form-control', 'required']) !!}
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              {!! Form::label('fornecedor_id', 'Fornecedor') !!}
              {!! Form::select('fornecedor_id', \App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(), 
                                                  null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('tipo_entrada_id', 'Tipo de entrada') !!}
              {!! Form::select('tipo_entrada_id', \App\TipoEntrada::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                    null, ['class'=>'form-control', 'required']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('data_entrada', 'Data de Entrada') !!}
            {!! Form::date('data_entrada', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('observacoes', 'Observações') !!}
            {!! Form::textarea('observacoes', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
            <a href="{{ route('entradas', []) }}" class="btn btn-danger">Cancelar</a>
          </div>
        {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
      </div>
    </div> 
@stop

 