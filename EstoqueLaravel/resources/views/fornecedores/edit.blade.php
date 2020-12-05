@extends('adminlte::page')

@section('content')
    <h3> Editando Fornecedor: {{ $fornecedor->razao_social }} </h3>

    @if($errors->any()) <!-- existe algum erro neste array? -->
      <ul class="alert alert-danger"> 
        @foreach($errors-all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    {!! Form::open(['route'=> ["fornecedores.update", 'id'=>$fornecedor->id], 'method'=>'put']) !!}
      <div class="form-group">
        {!! Form::label('cnpj', 'CNPJ') !!}
        {!! Form::text('cnpj', $fornecedor->cnpj, ['class'=>'form-control', 'required']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('razao_social', 'Nome Fantasia/Razão Social') !!}
        {!! Form::text('razao_social', $fornecedor->razao_social, ['class'=>'form-control', 'required']) !!}
      </div>
      
      <div class="form-group">
        {!! Form::label('email', 'E-mail') !!}
        {!! Form::text('email', $fornecedor->email, ['class'=>'form-control', 'required']) !!}
      </div>

      <div class="form-row">
        <div class="col">
          {!! Form::label('cep', 'CEP') !!}
          {!! Form::text('cep', $fornecedor->cep, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="col">
          {!! Form::label('endereco', 'Endereço') !!}
          {!! Form::text('endereco', $fornecedor->endereco, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="col">
          {!! Form::label('numero', 'Número') !!}
          {!! Form::text('numero', $fornecedor->numero, ['class'=>'form-control', 'required']) !!}
        </div>
      </div>

      <div class="form-row">
        <div class="col">
          {!! Form::label('complemento', 'Complemento') !!}
          {!! Form::text('complemento', $fornecedor->complemento, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="col">
          {!! Form::label('bairro', 'Bairro') !!}
          {!! Form::text('bairro', $fornecedor->bairro, ['class'=>'form-control', 'required']) !!}
        </div>
      </div>

      <div class="form-row">
        <div class="col">
          {!! Form::label('cidade', 'Cidade') !!}
          {!! Form::text('cidade', $fornecedor->cidade, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="col">
          {!! Form::label('estado', 'Estado') !!}
          {!! Form::text('estado', $fornecedor->estado, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="col">
          {!! Form::label('telefone', 'Telefone') !!}
          {!! Form::text('telefone', $fornecedor->telefone, ['class'=>'form-control', 'required']) !!}
        </div>
      </div>

      <br><div class="form-group">
        {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
        {!! Form::reset('Limpar', ['class'=>'btn btn-success']) !!}
        <a href="{{ route('fornecedores', []) }}" class="btn btn-danger">Voltar</a>
      </div>
    {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->

@stop