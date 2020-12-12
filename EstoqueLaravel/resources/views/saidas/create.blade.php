@extends('adminlte::page')

@section('content')
    @if($errors->any()) <!-- existe algum erro neste array? -->
      <ul class="alert alert-danger"> 
        @foreach($errors-all() as $error)
          <li>{{ dd($error) }}</li>
        @endforeach
      </ul>
    @endif

    <div class="card">
	    <div class="card-header" style="background: lightgrey">
	        <h3>Cadastro Saída de Produtos</h3>
	    </div>

      <div class="card-body">
        {!! Form::open(['route'=>'saidas.store']) !!}

          <div class="form-group">
            {!! Form::label('produto_id', 'Produto') !!}
            {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                  null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="form-row">
            <div class="col">
              {!! Form::label('tipo_saidas_id', 'Tipo de saída') !!}
              {!! Form::select('tipo_saidas_id', \App\TipoSaida::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                    null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('quantidade', 'Quantidade') !!}
              {!! Form::text('quantidade', null, ['class'=>'form-control', 'required']) !!}
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              {!! Form::label('preco_un', 'Preço') !!}
              {!! Form::text('preco_un', null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('data_saida', 'Data da Saída') !!}
              {!! Form::date('data_saida', null, ['class'=>'form-control', 'required']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('observacoes', 'Observações') !!}
            {!! Form::textarea('observacoes', null, ['class'=>'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('Limpar campos', ['class'=>'btn btn-success']) !!}
            <a href="{{ route('saidas', []) }}" class="btn btn-danger">Cancelar</a>
          </div>
      {!! Form::close() !!} 
    </div>
	</div>
@stop