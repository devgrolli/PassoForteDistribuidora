@extends('layouts.default')
@include('sweetalert::alert')
@include('layouts.spinner')
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
          {!! Form::open(['route'=>'pedidos.store']) !!}

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
@stop
@section('js')
	<script>
		$(document).ready(function(){
			var wrapper = $(".input_fields_wrap");
			var add_button = $(".add_field_button");
			var x=0;
			$(add_button).click(function(e){
        x++;
        e.preventDefault();
        var output = "<br>";
            output += '<div><div style="width:80%; float:left" id="ator">';
            output += '<div class="form-row"><div class="col"><input type="text" class="form-control" name="produtos[]" placeholder="Produto" required/></div>';
            output += '<div class="col"><input type="text" class="form-control" name="quantidades[]" placeholder="Quantidade" required/></div>';
            output += '</div></div><button type="button" class="remove_field btn btn-padrao2 btn-circle"><i class="fa fa-times"></button></div>';
        $(wrapper).append(output);
		  });
      $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); 
        $(this).parent('div').remove(); 
        x--;
      });
		})
	</script>
@stop