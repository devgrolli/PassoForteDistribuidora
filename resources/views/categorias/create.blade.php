
@section('content')
  @extends('layouts.default')
  <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div id="div_create">
    <div class="card">
      <div class="card-header">
        <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
          <h1 class="text-create"><strong>Cadastro categorias</strong></h1> 
        </div>
      </div>

      <div class="card-body" id="card_crud">
        {!! Form::open(['route'=>'categorias.store']) !!}
          <div class="form-group">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="form-group">
              {!! Form::label('descricao', 'Descrição') !!}
              {!! Form::text('descricao', null, ['class'=>'form-control']) !!}
          </div>

          <div class="form-group">
            <a href="{{ route('categorias', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
            {!! Form::button('Cadastrar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
            
          </div>
        {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
      </div>
    </div>
  </div>
@stop