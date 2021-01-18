@extends('layouts.default')

@section('content')
  @include('layouts.alerts')
    <div class="card">
      <div class="card-header" style="background: rgb(52, 58, 64)">
        <h3 style="color:rgb(255, 255, 255)"><strong>Editando: </strong>{{ $cliente->nome }}</h3>
      </div>
  
      <div class="card-body">
        {!! Form::open(['route'=> ["clientes.update", 'id'=>$cliente->id], 'method'=>'put']) !!}
          <div class="form-row">
            <div class="col">
              {!! Form::label('nome', 'Nome') !!}
              {!! Form::text('nome', $cliente->nome, ['class'=>'form-control', 'required']) !!}
            
            </div>
            <div class="col">
              {!! Form::label('email', 'E-mail') !!}
              {!! Form::email('email', $cliente->email, ['class'=>'form-control', 'required']) !!}
            </div>
  
            <div class="col">
              {!! Form::label('telefone', 'Telefone') !!}
              {!! Form::text('telefone', $cliente->telefone, ['class'=>'form-control', 'id'=>'telefone', 'maxlength' => 15, 'required']) !!}
            </div>
          </div>
  
          <div class="form-row">
            <div class="col">
              {!! Form::label('endereco', 'Endereço') !!}
              {!! Form::text('endereco', $cliente->endereco, ['class'=>'form-control', 'required']) !!}
            </div>
  
            <div class="col">
              {!! Form::label('tipo_cliente_id', 'Tipo do Cliente') !!}
              {!! Form::select('tipo_cliente_id', \App\TipoCliente::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                    $cliente->tipo_cliente_id, ['class'=>'form-control', 'required']) !!}
            </div>
          </div>
  
          <div class="form-row">
            <div class="col">
              {!! Form::label('descricao', 'Descrição') !!}
              {!! Form::textarea('descricao', null, ['class'=>'form-control']) !!}
            </div>
          </div><br>

          <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-padrao1']) !!}
            <a href="{{ route('clientes', []) }}" class="btn btn-padrao2">Cancelar</a>
          </div>
        {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
      </div>
    </div>
@stop