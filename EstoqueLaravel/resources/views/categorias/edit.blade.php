@extends('layouts.default')

@section('content')
    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div id="div_create">
        <div class="card">
            <div class="card-header">
                <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                    <h1 class="text-create"><strong>Editando categoria </strong></h1>
                </div>
            </div>

            <div class="card-body" id="card_crud">
                {!! Form::open(['route' => ['categorias.update', 'id' => $categoria->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', $categoria->nome, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('descricao', 'Descrição') !!}
                    {!! Form::text('descricao', $categoria->descricao, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::button('Salvar <i class="far fa-save"></i>', ['class' => 'btn btn-padrao1', 'type' =>'submit']) !!}
                    <a href="{{ route('categorias', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
                </div>
                {!! Form::close() !!}
                <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
            </div>
        </div>
    @stop
