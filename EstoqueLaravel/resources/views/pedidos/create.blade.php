@extends('layouts.default')
@section('content')
<link rel="stylesheet" type="text/css" href="../css/default-template.css">
  <div id="div_create">
    @include('layouts.spinner')
    <div class="card">
      <div class="card-header" style="background: rgb(52, 58, 64)">
        <h3 style="color:rgb(255, 255, 255)"><strong>Cadastro de Pedido</strong></h3>
      </div>

      <tbody>
        <div class="card-body" id="card_crud">
          {!! Form::open(['route'=>'pedidos.store', 'id'=>'dynamic_form', 'enctype'=>'application/json']) !!}

            <div class="form-row">
              <div class="col-md-2">
                {!! Form::label('data_pedido', 'Data do Pedido') !!}
                {!! Form::date('data_pedido', null, ['class' => 'form-control', 'required']) !!}
              </div>
              <div class="col-md-4">
                {!! Form::label('fornecedor_id', 'Fornecedor') !!}
                {!! Form::select('fornecedor_id', \App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(), 
                                                    null, ['class'=>'form-control', 'required']) !!}
              </div>  
            </div><br>
            
            <label>Clique no botão ao lado para adicionar produtos para o seu pedido <button class="add_field_button btn btn-padrao2"><i class="fa fa-plus" aria-hidden="true"></i> </button>
            </label>
            <div class="input_fields_wrap"></div><br>
            <div class="form-group">
              {!! Form::submit('Cadastrar', ['class'=>'btn btn-padrao1']) !!}
              <a href="{{ route('pedidos', []) }}" class="btn btn-padrao2">Cancelar</a>
            </div>
          {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
        </div>
      </tbody>
    </div>
  </div>
</div>
@include('sweetalert::alert')
@stop

@section('js')
	<script>
		$(document).ready(function(){
			var wrapper = $(".input_fields_wrap");
			var add_button = $(".add_field_button");
			var x=0;
			$(add_button).click(function(e){
        x++;
        var newField = `<br>
          <div><div style="width:80%; float:left" id="ator">
            <div class="form-row">
            <div class="col">
              {!! Form::text('items[produto]', null, ['class'=>'form-control', 'required', 'placeholder'=>'Produto']) !!}
            </div>

            <div class="col">
              {!! Form::text('items[quantidade]', null, ['class'=>'form-control', 'required', 'placeholder'=>'Quantidade']) !!}
            </div>
          </div>
          </div><button type="button" class="remove_field btn btn-padrao2 btn-circle"><i class="fa fa-times"></button></div>`;
        $(wrapper).append(newField);
		  });
      $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); 
        $(this).parent('div').remove(); 
        x--;
      });
		})
	</script>

@stop

{{-- 
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
  </div> --}}



{{-- <script>
$(document).ready(function(){
  var count =1;
  dynamic_field(count);

  function dynamic_field(number){
    var html = '<div class="form-row">';
    html += '<div class="col"> {!! Form::text("produto", null, ["class"=>"form-control", "required"]) !!} </div>'';
    if(number >1){
      html += '<button class="btn btn-padrao1" type="button" name="remove" id="remove"> Remove <i class="fa fa-search"></i></button>';
      $('tbody').append(html);
    }else{
      html += "<button class='btn btn-padrao1' type='button' name='add' id='add'> Add <i class='fa fa-search'></i></button>";
      $('tbody').append(html);
    }
  }

  $('#add').click(function(){
    count++;
    dynamic_field(count);
  });

  $(document).on('click', '#remove', function(){
    count--;
    dynamic_field(count);
  });

  $('#dynamic_form').on('submit', function(event){
    even.preventDefault();
    $ajax({
      url:'{{route("pedidos.store") }}',
      method: 'post',
      data:$(this).serialize(),
      dataType:'json', 
      beforeSend:function(){
        $('#save').attr('disabled', 'disabçed');
      },
      success:function(data){
        if(data.error){
          var error_html = '';
          for(var count=0; count < data.error.length; count++){
            error_html += '<p>' +data.error[count]+ '</p>';
          }
          $('#result').html('<div class="alert alert-danger">' +error_html+ '</div>');
        }else{
          dynamic_field(1);
          $('#result').html('<div class="alert alert-success">' +data.success+ '</div>');
        }
        $('#save').attr('disabled', false); 
      }
    })
  });
  
});

</script> --}}