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
	        <h3>Editando Saída de Produto</h3>
	    </div>

      <div class="card-body">
        {!! Form::open(['route'=> ["saidas.update", 'id'=>$saida->id], 'method'=>'put']) !!}

        <div class="form-group">
          {!! Form::label('produto_id', 'Produto') !!}
          {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                $saida->produto_id, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('tipo_saidas_id', 'Tipo da Saída') !!}
            {!! Form::select('tipo_saidas_id', \App\TipoSaida::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                  $saida->tipo_saidas_id, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::text('quantidade',  $saida->quantidade, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('preco_un', 'Preço') !!}
            {!! Form::text('preco_un', $saida->preco_un, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('data_saida', 'Data da Saída') !!}
            {!! Form::date('data_saida', $saida->data_saida, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('observacoes', 'Observações') !!}
          {!! Form::textarea('observacoes', $saida->observacoes, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
          <a href="{{ route('saidas', []) }}" class="btn btn-danger">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
    </div>
	</div>
@stop