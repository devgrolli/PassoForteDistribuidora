@extends('adminlte::page')

@section('content')
    <h3> Editando Ator: {{ $ator->nome }} </h3>

    @if($errors->any()) <!-- existe algum erro neste array? -->
      <ul class="alert alert-danger"> 
        @foreach($errors-all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    {!! Form::open(['route'=> ["entradas.update", 'id'=>$ator->id], 'method'=>'put']) !!}

        <div class="form-group">
          {!! Form::label('nacionalidade_id', 'Nacionalidade') !!}
          {!! Form::select('nacionalidade_id', \App\Nacionalidade::orderBy('descricao')->pluck('descricao', 'id')->toArray(), 
                                                $ator->nacionalidade_id, ['class'=>'form-control', 'required']) !!}
        </div>
        
        < < class="form-group">
          {!! Form::label('produto_id', 'Produto') !!}
          {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                null, ['class'=>'form-control', 'required']) !!}
        </>

        <div class="form-row">
          <div class="col">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::date('quantidade', null, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('preco_un', 'Preço Unitário') !!}
            {!! Form::date('preco_un', null, ['class'=>'form-control', 'required']) !!}
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
          {!! Form::text('observacoes', null, ['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
          {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar', ['class'=>'btn btn-success']) !!}
          <a href="{{ route('atores', []) }}" class="btn btn-danger">Voltar</a>
        </div>
    {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->

@stop