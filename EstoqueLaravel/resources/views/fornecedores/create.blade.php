@extends('layouts.default')
@section('content')
@include('layouts.spinner')
    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div id="div_create">
        <div class="card">
            <div class="card-header">
                <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                    <h1 class="text-create"><strong>Cadastrando fornecedor </strong></h1>
                </div>
            </div>

            <div class="card-body" id="card_crud">
            {!! Form::open(['route' => 'fornecedores.store']) !!}

            <div class="form-row">
                <div class="form-group col-md-2">
                    {!! Form::label('cnpj', 'CNPJ') !!}
                    {!! Form::text('cnpj', null, ['class' => 'form-control', 'id' => 'cnpj', 'required', 'maxlength' =>'18']) !!}
                </div>

                <div class="form-group col-md-6">
                    {!! Form::label('razao_social', 'Nome Fantasia/Razão Social') !!}
                    {!! Form::text('razao_social', null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    {!! Form::label('cep', 'CEP') !!}
                    {!! Form::text('cep', null, ['class' => 'form-control', 'id' => 'cep', 'required']) !!}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('endereco', 'Endereço') !!}
                    {!! Form::text('endereco', null, ['class' => 'form-control', 'id' => 'rua', 'required']) !!}
                </div>

                <div class="form-group col-md-1">
                    {!! Form::label('numero', 'Número') !!}
                    {!! Form::number('numero', null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group col-md-3">
                    {!! Form::label('complemento', 'Complemento') !!}
                    {!! Form::text('complemento', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-md-2">
                    {!! Form::label('bairro', 'Bairro') !!}
                    {!! Form::text('bairro', null, ['class' => 'form-control', 'id' => 'bairro', 'required']) !!}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    {!! Form::label('cidade', 'Cidade') !!}
                    {!! Form::text('cidade', null, ['class' => 'form-control', 'id' => 'cidade', 'required']) !!}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::text('estado', null, ['class' => 'form-control', 'id' => 'uf', 'required']) !!}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('telefone', 'Telefone') !!}
                    {!! Form::text('telefone', null, ['class' => 'form-control', 'id' => 'telefone', 'maxlength' => 15,
                    'required']) !!}
                </div>
            </div>
            <br>
            <div class="form-group">
                {!! Form::button('Cadastrar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
                <a href="{{ route('fornecedores', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
    @include('sweetalert::alert')
    @include('layouts.cep')
    @include('layouts.mascaras')
@stop