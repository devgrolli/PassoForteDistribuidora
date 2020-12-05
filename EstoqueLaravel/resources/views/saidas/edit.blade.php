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

    {!! Form::open(['route'=> ["saidas.update", 'id'=>$ator->id], 'method'=>'put']) !!}
      <div class="form-group">
        {!! Form::label('produto_id', 'Produto') !!}
        {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                              $saidas->produto_id, ['class'=>'form-control', 'required']) !!}
      </div>

      <div class="form-row">
        <div class="col">
          {!! Form::label('tipo_saida_id', 'Tipo da Saída') !!}
          {!! Form::select('tipo_saida_id', \App\TipoSaida::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                $saidas->tipo_saida_id, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="col">
          {!! Form::label('quantidade', 'Quantidade') !!}
          {!! Form::text('quantidade',  $saidas->quantidade, ['class'=>'form-control', 'required']) !!}
        </div>
      </div>

      <div class="form-row">
        <div class="col">
          {!! Form::label('preco_un', 'Preço') !!}
          {!! Form::text('preco_un', $saidas->preco_un, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="col">
          {!! Form::label('data_saida', 'Data da Saída') !!}
          {!! Form::date('data_saida', $saidas->data_saida, ['class'=>'form-control', 'required']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('observacoes', 'Observações') !!}
        {!! Form::textarea('observacoes', $saidas->observacoes, ['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        {!! Form::reset('Limpar campos', ['class'=>'btn btn-success']) !!}
        <a href="{{ route('saidas', []) }}" class="btn btn-danger">Voltar</a>
      </div>
    {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->

@stop