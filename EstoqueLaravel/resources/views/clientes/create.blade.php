@section('content')
@include('sweetalert::alert')
@extends('layouts.default')
@include('layouts.spinner')
@include('layouts.cep')
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
              {!! Form::select('tipo_cliente_id', \App\TipoCliente::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class'=>'form-control select_search', 'required']) !!}
            </div>
          </div>
          <br>

          <div class="form-group col-md-2" id="check-endereco">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" value="simplificado" checked>
              <label class="form-check-label" for="flexRadioDefault2">
                Endereço Simplificado
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" value="completo">
              <label class="form-check-label" for="flexRadioDefault1">
                Endereço Completo
              </label>
            </div>
          </div>

          <div class="input_fields_wrap"></div><br>

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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    var wrapper = $(".input_fields_wrap");
    $('.form-check-input').change(function(){
      selected_value = $("input[name='flexRadioDefault']:checked").val();

      if(selected_value == 'completo'){
        console.log(selected_value);
        var newField = `
        <div id="form-completo">
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

              <div class="col">
                {!! Form::label('estado', 'Estado') !!}
                {!! Form::text('estado', null, ['class' => 'form-control', 'id' => 'uf', 'required']) !!}
              </div>
          </div>
        </div>`;
        $(wrapper).append(newField);
      }else{
        $('#form-completo').remove(); 
      }
    });
  });
</script>


