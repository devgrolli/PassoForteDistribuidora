
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('#produto_nome').on('change', function(){
        var valor = $(this).val();
        var route = "{{ URL('saidas/getprods') }}";
        var url = route+"/"+valor;

        if(valor !== ''){
            $.ajax({
            type: "GET",
            url: url,
            data: valor,
            dataType: "json",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },success:function(response){
                if (response.length > 0 && typeof response !== 'string'){
                option += '<option>'+ 'Selecione uma Validade' +'</option>';    
                $.each(response, function(i, obj){
                    var dataFormatada = obj.validade.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                    option += '<option>'+dataFormatada+'</option>';
                });
                $('#validade_produto').html(option).show();
                $('#validade_produto').on('change', function(){
                    var set_preco = $('#validade_produto').val();
                    if (set_preco !== 'Selecione uma Validade'){
                    $.each(response, function(i, obj){
                        var dataFormatada = obj.validade.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');
                        if (set_preco === dataFormatada) {
                        number = formatReal(obj.preco_un)
                        $('#preco_un').val(number);
                        }
                    });
                    }else{
                    $('#preco_un').val('');
                    $('#valor').val('');
                    }
                });
                }else{
                var option = '<option></option>';
                $('#validade_produto').html(option).show();
                }
            },error:function(response){
                console.log("Ocorreu algum erro");
            }
            });
        }else{
            $('#validade_produto').empty();
            $('#preco_un').val('');
            $('#valor').val('');
        }
        });
    });
    

    function formatReal(numero) {
        var tmp = numero + '';
        var neg = false;

        if (tmp - (Math.round(numero)) == 0) tmp = tmp + '00';
        if (tmp.indexOf(".")) tmp = tmp.replace(".", "");
        if (tmp.indexOf("-") == 0) {
        neg = true;
        tmp = tmp.replace("-", "");
        }

        if (tmp.length == 1) tmp = "0" + tmp
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if (tmp.length > 6) tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        if (tmp.length > 9) tmp = tmp.replace(/([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2,$3");
        if (tmp.length = 12) tmp = tmp.replace(/([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2.$3,$4");
        if (tmp.length > 12) tmp = tmp.replace(/([0-9]{3}).([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2.$3.$4,$5");
        if (tmp.indexOf(".") == 0) tmp = tmp.replace(".", "");
        if (tmp.indexOf(",") == 0) tmp = tmp.replace(",", "0,");

        return (neg ? '-' + tmp : tmp);
    }

</script>
