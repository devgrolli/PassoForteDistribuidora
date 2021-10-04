@extends('layouts.default')

@section('content')
    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div class="card">
        <div class="card-header" style="background: rgb(52, 58, 64)">
            <h3 style="color:rgb(255, 255, 255)"><strong>Editando Tipos de Saída</strong></h3>
        </div>

        <div class="card-body">
            {!! Form::open(['route' => ['tipo_saidas.update', 'id' => $tipo_saida->id], 'method' => 'put']) !!}
            <div class="form-group">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', $tipo_saida->nome, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('descricao', 'Descrição') !!}
                {!! Form::text('descricao', $tipo_saida->descricao, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Salvar', ['class' => 'btn btn-padrao1']) !!}
                <a href="{{ route('tipo_saidas', []) }}" class="btn btn-padrao2">Cancelar</a>
            </div>

            {!! Form::close() !!}
            <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
        </div>
    </div>
@stop
