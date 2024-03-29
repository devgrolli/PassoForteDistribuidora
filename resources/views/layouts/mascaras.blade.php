<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $(document).ready(function($){
      $('#telefone').mask('(00) 00000-0000');
      $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
      $('.date').mask('00/00/0000');
      $('.time').mask('00:00:00');
      $('.date_time').mask('00/00/0000 00:00:00');
      $('#cep').mask('00000-000');
      $('.phone_with_ddd').mask('(00) 0000-0000');
      $('.phone_us').mask('(000) 000-0000');
      $('.cpf').mask('000.000.000-00', {reverse: true});
      $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
      $('.money').mask('000.000.000.000.000,00', {reverse: true});
      $('.money2').mask("#.##0,00", {reverse: true});
  });
</script>
