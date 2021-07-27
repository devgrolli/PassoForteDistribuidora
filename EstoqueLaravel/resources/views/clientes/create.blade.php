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
                  <h1 class="text-create"><strong>Cadastro cliente </strong></h1>
              </div>
          </div>

          <div class="card-body" id="card_crud">
          {!! Form::open(['route'=>'clientes.store']) !!}

          <div class="form-row">
            <div class="form-group col-md-6">
              {!! Form::label('nome', 'Nome') !!}
              {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
            
            </div>
            <div class="form-group col-md-4">
              {!! Form::label('email', 'E-mail') !!}
              {!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
            </div>

            <div class="form-group col-md-2">
              {!! Form::label('telefone', 'Telefone') !!}
              {!! Form::text('telefone', null, ['class' => 'form-control', 'id'=>'telefone', 'maxlength' => 15, 'required', 'attrname'=>'telefone']) !!}
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              {!! Form::label('endereco', 'Endereço') !!}
              {!! Form::text('endereco', null, ['class'=>'form-control', 'required']) !!}
            </div>

            <div class="col">
              {!! Form::label('tipo_cliente_id', 'Tipo do Cliente') !!}
              {!! Form::select('tipo_cliente_id', \App\TipoCliente::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                    null, ['class'=>'form-control select_search', 'required']) !!}
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              {!! Form::label('descricao', 'Descrição') !!}
              {!! Form::textarea('descricao', null, ['class'=>'form-control']) !!}
            </div>
          </div><br>
          <div class="form-group">
            {!! Form::button('Cadastrar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
            <a href="{{ route('clientes', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
          </div>
        {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
      </div>
    </div>
  </div>
@stop
