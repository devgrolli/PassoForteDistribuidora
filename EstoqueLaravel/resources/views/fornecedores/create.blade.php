@extends('layouts.default')

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
        <h3><strong>Cadastro Saída de Produtos</strong></h3>
    </div>

    <div class="card-body">
      {!! Form::open(['route'=>'fornecedores.store']) !!}

        <div class="form-row">
          <div class="col">
            {!! Form::label('cnpj', 'CNPJ') !!}
            {!! Form::text('cnpj', null, ['class'=>'form-control', 'id'=>'cnpj', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('razao_social', 'Nome Fantasia/Razão Social') !!}
            {!! Form::text('razao_social', null, ['class'=>'form-control', 'required']) !!}
          </div>
        
          <div class="col">
            {!! Form::label('email', 'E-mail') !!}
            {!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('cep', 'CEP') !!}
            {!! Form::text('cep', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('endereco', 'Endereço') !!}
            {!! Form::text('endereco', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('numero', 'Número') !!}
            {!! Form::text('numero', null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('complemento', 'Complemento') !!}
            {!! Form::text('complemento', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('bairro', 'Bairro') !!}
            {!! Form::text('bairro', null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('cidade', 'Cidade') !!}
            {!! Form::text('cidade', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('estado', 'Estado') !!}
            {!! Form::text('estado', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('telefone', 'Telefone') !!}
            {!! Form::text('telefone', null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        </br><div class="form-group">
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar campos', ['class'=>'btn btn-success']) !!}
          <a href="{{ route('fornecedores', []) }}" class="btn btn-danger">Voltar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
@stop
