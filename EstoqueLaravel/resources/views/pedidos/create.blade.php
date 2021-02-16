@extends('layouts.default')
@section('content')
  @include('layouts.alerts')
   <div class="card">
    <div class="card-header" style="background: rgb(52, 58, 64)">
      <h3 style="color:rgb(255, 255, 255)"><strong>Cadastro Saída de Produtos</strong></h3>
    </div>

    <tbody>
    <div class="card-body">
      {!! Form::open(['route'=>'pedidos.store', 'id'=>'dynamic_form']) !!}

        <div class="form-row">
          <div class="col">
            {!! Form::label('produto', 'Produtos') !!}
            {!! Form::text('produto', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="col">
            {!! Form::label('quantidade', 'Quantidades') !!}
            {!! Form::text('quantidade', null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('fornecedor_id', 'Fornecedor') !!}
            {!! Form::select('fornecedor_id', \App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(), 
                                                null, ['class'=>'form-control', 'required']) !!}
          </div>  
        </div> 

        </br><div class="form-group">
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-padrao1']) !!}
          <a href="{{ route('pedidos', []) }}" class="btn btn-padrao2">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
</tbody>
@stop

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