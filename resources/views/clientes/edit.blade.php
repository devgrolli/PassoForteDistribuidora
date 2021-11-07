@section('content')
@include('sweetalert::alert')
@extends('layouts.default')
@include('layouts.spinner')
@include('layouts.mascaras')
@extends('layouts.select_search')

<link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div id="div_create">
        <div class="card">
            <div class="card-header">
                <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                    <h1 class="text-create"><strong>Editando: {{$cliente->nome}} </strong></h1>
                </div>
            </div>

            <div class="card-body" id="card_crud">
                {!! Form::open(['route' => ['clientes.update', 'id' => $cliente->id], 'method' => 'put']) !!}
                    <div class="form-row">
                        <div class="col">
                            {!! Form::label('nome', 'Nome') !!}
                            {!! Form::text('nome', $cliente->nome, ['class' => 'form-control', 'required']) !!}

                        </div>
                        <div class="col">
                            {!! Form::label('email', 'E-mail') !!}
                            {!! Form::email('email', $cliente->email, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col">
                            {!! Form::label('telefone', 'Telefone') !!}
                            {!! Form::text('telefone', $cliente->telefone, ['class' => 'form-control', 'id' => 'telefone', 'maxlength' => 15, 'required']) !!}
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            {!! Form::label('endereco', 'Endereço') !!}
                            {!! Form::text('endereco', $cliente->endereco, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col">
                            {!! Form::label('tipo_cliente_id', 'Tipo do Cliente') !!}
                            {!! Form::select('tipo_cliente_id',\App\TipoCliente::orderBy('nome')->pluck('nome', 'id')->toArray(), $cliente->tipo_cliente_id,['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            {!! Form::label('descricao', 'Descrição') !!}
                            {!! Form::textarea('descricao', null, ['class' => 'form-control']) !!}
                        </div>
                    </div><br>

                    <div class="form-group">
                        <a href="{{ route('clientes', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
                        {!! Form::button('Salvar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
