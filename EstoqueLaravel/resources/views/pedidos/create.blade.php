@extends('layouts.default')
@section('content')
  @include('layouts.alerts')
   <div class="card">
    <div class="card-header" style="background: rgb(52, 58, 64)">
      <h3 style="color:rgb(255, 255, 255)"><strong>Cadastro Saída de Produtos</strong></h3>
    </div>

    <div class="card-body">
      {!! Form::open(['route'=>'pedidos.store']) !!}

        <div class="form-row">
          <div class="col">
            {!! Form::label('produto', 'Produtos') !!}
            {!! Form::text('produto', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('quantidade', 'Quantidades') !!}
            {!! Form::text('quantidade', null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('data_pedido', 'Data do Pedido') !!}
            {!! Form::date('data_pedido', null, ['class'=>'form-control', 'required']) !!}                                   
          </div>
          <div class="col">
            {!! Form::label('fornecedor_id', 'Fornecedor') !!}
            {!! Form::select('fornecedor_id', \App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(), 
                                                null, ['class'=>'form-control', 'required']) !!}
          </div>  
        </div> 

        </br><div class="form-group">
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-padrao1']) !!}
          <a href="{{ route('pedidos', []) }}" class="btn btn-padrao2">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
@stop