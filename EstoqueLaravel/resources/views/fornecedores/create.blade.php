@extends('layouts.default')
@section('content')
    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div id="div_create">
        <div class="card">
            <div class="card-header">
                <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                    <h1 class="text-create"><strong>Cadastrando fornecedor </strong></h1>
                </div>
            </div>

            <div class="card-body" id="card_crud">
            {!! Form::open(['route' => 'fornecedores.store']) !!}

            <div class="form-row">
                <div class="form-group col-md-2">
                    {!! Form::label('cnpj', 'CNPJ') !!}
                    {!! Form::text('cnpj', null, ['class' => 'form-control', 'id' => 'cnpj', 'required', 'maxlength' =>'18']) !!}
                </div>

                <div class="form-group col-md-6">
                    {!! Form::label('razao_social', 'Nome Fantasia/Razão Social') !!}
                    {!! Form::text('razao_social', null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

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

                <div class="form-group col-md-4">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::text('estado', null, ['class' => 'form-control', 'id' => 'uf', 'required']) !!}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('telefone', 'Telefone') !!}
                    {!! Form::text('telefone', null, ['class' => 'form-control', 'id' => 'telefone', 'maxlength' => 15,
                    'required']) !!}
                </div>
            </div>

            {{-- <div class="form-group row">
                <label class="col-form-label-lg text-sm-right form-label col-form-label col-sm-2    ">
                    Large label
                </label>
                <div class="col-sm-10">
                    <input class="form-control form-control-lg"> 
                </div>

            </div> --}}

            </br>
            <div class="form-group">
                {!! Form::button('Cadastrar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
                  <a href="{{ route('fornecedores', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
            </div>
            {!! Form::close() !!}
            <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
        </div>
    </div>
    </div>
@stop

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript" /></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            swal.fire("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    swal.fire("Formato de CEP inválido.");
                    // alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });

    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    function mtel(v) {
        v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
        v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
        return v;
    }

    function id(el) {
        return document.getElementById(el);
    }
    window.onload = function() {
        id('telefone').onkeyup = function() {
            mascara(this, mtel);
        }
    }
</script>
