@extends('layouts.default') 

@section('content')
<link rel="stylesheet" type="text/css" href="../css/default-template.css">
<div id="div_create">
    <div class="card">
        <div class="card-header">
            <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                <h1 class="text-create"><strong>Saída de Produtos
                  <button class="btn btn-padrao2" type="button" data-toggle="modal" data-target="#exampleModal">
                    Visualizar estoque <i class="fa fa-search"></i></button></strong></strong>
                </h1>
            </div>
        </div>
      <div class="card-body" id="card_crud">
        {!! Form::open(['route' => 'saidas.store']) !!}
        <div class="form-row">
          <div class="col">
            {!! Form::label('produto_id', 'Produto') !!}
            {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                null, ['class'=>'form-control', 'id'=>'produto_nome', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('validade_produto', 'Validade do Produto') !!}
            <select name="validade_produto" class="form-control" id="validade_produto">
              <option></option>
            </select>
          </div>
          <div class="col">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::number('quantidade', null, ['class'=>'form-control', 'required', 'pattern' => '[0-9]+([,\.][0-9]+)?']) !!}
          </div>
          <div class="col">
            {!! Form::label('preco_un', 'Preço') !!}
            {!! Form::text('preco_un', null, ['class'=>'form-control', 'id'=>'valor', 'onkeyup'=>"formatarMoeda()", 'placeholder'=>'R$', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('tipo_saidas_id', 'Tipo de saída') !!}
            {!! Form::select('tipo_saidas_id', \App\TipoSaida::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                  null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('observacoes', 'Observações') !!}
          {!! Form::textarea('observacoes', null, ['class'=>'form-control', 'id'=>'cal']) !!}
        </div>

        <div class="form-group">
          {!! Form::button('Cadastrar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
            <a href="{{ route('saidas', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
        </div>
      {!! Form::close() !!} 
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estoque</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-hover" id="table">
                    <thead class="letra" id="thead_colors">
                      <th>Nome</th>
                      <th>Quantidade</th>
                    </thead>
                    <tbody>
                      @foreach ($products as $product)
                        <tr>
                          <td>{{ $product->nome }}</td>
                          <td>{{ $product->quantidade }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
  @include('sweetalert::alert')
@stop

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
  function formatarMoeda() {
    var elemento = document.getElementById('valor');
    var valor = elemento.value;
    valor = valor + '';
    valor = parseInt(valor.replace(/[\D]+/g, ''));
    valor = valor + '';
    valor = valor.replace(/([0-9]{2})$/g, ",$1");
    if(valor.length > 6) valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    elemento.value = valor;
    if(valor == 'NaN') elemento.value = '';
  }

  $(document).ready(function() {
    var valor = $('#produto_nome').val();
    $('#produto_nome').on('change', function(){
      var valor = $(this).val();
      var url = "{{ URL('saidas/getprods') }}";

      var dltUrl = url+"/"+valor;
        $.ajax({
          type: "GET",
          url: dltUrl,
          data: valor,
          dataType: "json",
          headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
          },
          success:function(response){
            if (response.length > 0 && typeof response !== 'string'){
              $.each(response, function(i, obj){
                console.log(obj);
                var dataFormatada = obj.validade.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                option += '<option>'+dataFormatada+'</option>';
              })
              $('#validade_produto').html(option).show();
            }else{
              var option = '<option>PRODUTO SEM VALIDADE</option>';
              $('#validade_produto').html(option).show();
            }
          },error:function(response){ 
            console.log(response);
            console.log(token);
            console.log("ERROR");
        }
      });
    });
  });
  
</script>

