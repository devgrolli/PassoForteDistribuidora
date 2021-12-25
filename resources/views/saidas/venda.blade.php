@section('content')
  @extends('layouts.default') 
  @include('sweetalert::alert')
  @include('layouts.formata_moeda')
  @include('modals.modal_estoque')
  @extends('layouts.select_search')

  <link rel="stylesheet" type="text/css" href="../css/default-template.css">
  <div id="div_create">
    <div class="card">
      <div class="card-header">
        <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
          <strong>
            <h1 class="text-create">Saída de Produtos
              <button class="btn btn-padrao2" type="button" data-toggle="modal" data-target="#exampleModalEstoque"> Visualizar estoque <i class="fa fa-search"></i></button>
            </h1>
          </strong>
        </div>
      </div>
        <div class="card-body" id="card_crud">
          {!! Form::open(['route' => 'saidas.store']) !!}
            
          


    
            
            <button class="add_field_button btn btn-padrao1" style="margin-left: 10px;!important"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
            <div style="margin-top: 10px;!important" class="input_fields_wrap"></div>
            <br>


          <div class="form-group">
            <a href="{{ route('saidas', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
            {!! Form::button('Cadastrar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
          </div>
        {!! Form::close() !!} 
      </div>
    </div>
  </div>
  @include('layouts.spinner')
@stop
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	<script>
		$(document).ready(function() {
			var wrapper = $(".input_fields_wrap");
			var add_button = $(".add_field_button");
			var x=1;
			$(add_button).click(function(e){
                x++;
                e.preventDefault();


                var recebe = ` 
                    <div class="form-row">
                        <div class="col">
                            {!! Form::Label('produto_id', 'Produto') !!}
                            <select class="selectpicker form-control select_search produto_nome" data-live-search="true" name="produto_id" required>
                                <option value="">Selecione um Produto</option>
                                @foreach($products as $p)
                                    <option value="{{$p->id}}">{{$p->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            {!! Form::label('validade_produto', 'Validade') !!}
                            <select name="validade_produto" class="form-control select_search validade_produto" required>
                                <option></option>
                            </select>
                        </div>

                        <div class="col">
                            {!! Form::label('preco_un', 'Preço Entrada') !!}
                            {!! Form::text('preco_un', null, ['class'=>'form-control', 'id'=>'preco_un', 'placeholder'=>'R$', 'readonly']) !!}
                        </div>

                        <div class="col">
                            {!! Form::label('estoque', 'Estoque') !!}
                            {!! Form::text('estoque', null, ['class'=>'form-control', 'id'=>'estoque', 'readonly']) !!}
                        </div>

                        <div class="col">
                            {!! Form::label('preco_saida', 'Preço Venda') !!}
                            {!! Form::text('preco_saida', null, ['class'=>'form-control', 'id'=>'valor', 'onkeyup'=>"formatarMoeda()", 'placeholder'=>'R$', 'required']) !!}
                        </div>

                        <div class="form-group col-md-2">
                            {!! Form::label('qtd_venda', 'Quantidade') !!}
                            {!! Form::text('qtd_venda', null, ['class'=>'form-control', 'id'=>'qtd_venda', 'required']) !!}
                        </div>

                        
                    </div>
                `;
                $(wrapper).append(recebe);

                $('.produto_nome').each(function () {
                    $(this).change(function () {
                        var valor = $(this).val();
                        var route = "{{ URL('saidas/dynamic_venda') }}";
                        var url = route + "/" + valor;

                        if (valor !== '') {
                            $.ajax({
                                type: "GET",
                                url: url,
                                data: valor,
                                dataType: "json",
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response[0].length > 0 && typeof response[0] !== 'string') {
                                        option += '<option>' + 'Selecione uma Validade' + '</option>';
                                        $.each(response[0], function(i, obj) {
                                            var dataFormatada = obj.validade.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                                            option += '<option>' + dataFormatada + '</option>';
                                        });

                                        $('.validade_produto').html(option).show();

                                        $('.validade_produto').each(function () {
                                            $(this).change(function () {
                                                var set_preco = $('.validade_produto').val();
                                                if (set_preco !== 'Selecione uma Validade') {
                                                    $.each(response[0], function(i, obj) {
                                                        var dataFormatada = obj.validade.replace(/(\d*)-(\d*)-(\d*).*/,'$3/$2/$1');
                                                        if (set_preco === dataFormatada) {
                                                            number = converteFloatMoeda(obj.preco_un)
                                                            $('#preco_un').val(number);

                                                            $.each(response[1], function(x, obj_estoque) {
                                                                if(obj_estoque.id == obj.produto_id){
                                                                    $('#estoque').val(obj_estoque.quantidade);
                                                                }
                                                            });
                                                        }
                                                    });
                                                } else {
                                                    $('#preco_un').val('');
                                                    $('#valor').val('');
                                                }
                                            });
                                        });
                                    } else {
                                        var option = '<option></option>';
                                        $('.validade_produto').html(option).show();
                                    }
                                },
                                error: function(response) {
                                    swal.fire("Ocorreu um erro ao processar os dados, contate o suporte.");
                                }
                            });
                        } else {
                            $('.validade_produto').empty();
                            $('#preco_un').val('');
                            $('#valor').val('');
                        }
                    });
                });
            });
            $(wrapper).on("click",".remove_field", function(e){
                e.preventDefault(); 
                $(this).parent('div').remove(); 
                x--;
            });
        });


        function converteFloatMoeda(valor) {
            var inteiro = null,
                decimal = null,
                c = null,
                j = null;
            var aux = new Array();
            valor = "" + valor;
            c = valor.indexOf(".", 0);
            if (c > 0) {
                inteiro = valor.substring(0, c);
                decimal = valor.substring(c + 1, valor.length);
            } else {
                inteiro = valor;
            }
            for (j = inteiro.length, c = 0; j > 0; j -= 3, c++) {
                aux[c] = inteiro.substring(j - 3, j);
            }
            inteiro = "";
            for (c = aux.length - 1; c >= 0; c--) {
                inteiro += aux[c] + '.';
            }
            inteiro = inteiro.substring(0, inteiro.length - 1);
            decimal = parseInt(decimal);
            if (isNaN(decimal)) {
                decimal = "00";
            } else {
                decimal = "" + decimal;
                if (decimal.length === 1) {
                    decimal = decimal + "0";
                }
            }
            valor = inteiro + "," + decimal;
            return valor;
        }
        
	</script>
