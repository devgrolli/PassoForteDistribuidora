@section('content')
@include('sweetalert::alert')
@extends('layouts.default')
@include('layouts.cep')
@include('layouts.mascaras')
    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div id="div_create">
        <div class="card">
            <div class="card-header">
                <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                    <h1 class="text-create"><strong>Editando fornecedor </strong></h1>
                </div>
            </div>

            <div class="card-body" id="card_crud">
                {!! Form::open(['route' => ['fornecedores.update', 'id' => $fornecedor->id], 'method' => 'put']) !!}

                <div class="form-row">
                    <div class="form-group col-md-2">
                        {!! Form::label('cnpj', 'CNPJ') !!}
                        {!! Form::text('cnpj', $fornecedor->cnpj, ['class' => 'form-control', 'id' => 'cnpj', 'required', 'maxlength' => '18']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('razao_social', 'Nome Fantasia/Razão Social') !!}
                        {!! Form::text('razao_social', $fornecedor->razao_social, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('email', 'E-mail') !!}
                        {!! Form::email('email', $fornecedor->email, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        {!! Form::label('cep', 'CEP') !!}
                        {!! Form::text('cep', $fornecedor->cep, ['class' => 'form-control', 'id' => 'cep', 'required']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('endereco', 'Endereço') !!}
                        {!! Form::text('endereco', $fornecedor->endereco, ['class' => 'form-control', 'id' => 'rua', 'required']) !!}
                    </div>

                    <div class="form-group col-md-1">
                        {!! Form::label('numero', 'Número') !!}
                        {!! Form::number('numero', $fornecedor->numero, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group col-md-3">
                        {!! Form::label('complemento', 'Complemento') !!}
                        {!! Form::text('complemento', $fornecedor->complemento, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-2">
                        {!! Form::label('bairro', 'Bairro') !!}
                        {!! Form::text('bairro', $fornecedor->bairro, ['class' => 'form-control', 'id' => 'bairro', 'required']) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        {!! Form::label('cidade', 'Cidade') !!}
                        {!! Form::text('cidade', $fornecedor->cidade, ['class' => 'form-control', 'id' => 'cidade', 'required']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('estado', 'Estado') !!}
                        {!! Form::text('estado', $fornecedor->estado, ['class' => 'form-control', 'id' => 'uf', 'required']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('telefone', 'Telefone') !!}
                        {!! Form::text('telefone', $fornecedor->telefone, ['class' => 'form-control', 'id' => 'telefone', 'maxlength' => 15, 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <a href="{{ route('fornecedores', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
                    {!! Form::button('Salvar <i class="far fa-save"></i>', ['class' => 'btn btn-padrao1', 'type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
                <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
            </div>
        </div>
    </div>
    @include('layouts.spinner')
@stop
