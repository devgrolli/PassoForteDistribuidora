<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        $('#produto_nome').on('change', function() {
            var valor = $(this).val();
            var route = "{{ URL('saidas/getprods') }}";
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
                        if (response.length > 0 && typeof response !== 'string') {
                            option += '<option>' + 'Selecione uma Validade' + '</option>';
                            $.each(response, function(i, obj) {
                                var dataFormatada = obj.validade.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                                option += '<option>' + dataFormatada + '</option>';
                            });
                            $('#validade_produto').html(option).show();
                            $('#validade_produto').on('change', function() {
                                var set_preco = $('#validade_produto').val();
                                if (set_preco !== 'Selecione uma Validade') {
                                    $.each(response, function(i, obj) {
                                        var dataFormatada = obj.validade.replace(/(\d*)-(\d*)-(\d*).*/,'$3/$2/$1');
                                        if (set_preco === dataFormatada) {
                                            number = converteFloatMoeda(obj.preco_un)
                                            $('#preco_un').val(number);
                                        }
                                    });
                                } else {
                                    $('#preco_un').val('');
                                    $('#valor').val('');
                                }
                            });
                        } else {
                            var option = '<option></option>';
                            $('#validade_produto').html(option).show();
                        }
                    },
                    error: function(response) {
                        swal.fire("Ocorreu um erro ao processar os dados, contate o suporte.");
                    }
                });
            } else {
                $('#validade_produto').empty();
                $('#preco_un').val('');
                $('#valor').val('');
            }
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
