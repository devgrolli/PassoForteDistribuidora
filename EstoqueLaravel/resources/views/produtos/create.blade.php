@extends('adminlte::page')

@section('content')
   @include('layouts.alerts')

   
   <div class="card">
    <div class="card-header" style="background: rgb(52, 58, 64)">
        <h3 style="color:rgb(255, 255, 255)"><strong>Cadastro Produtos</strong></h3>
    </div>

    <div class="card-body">
      {!! Form::open(['route'=>'produtos.store']) !!}

          <div class="col">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', null, ['class'=>'form-control']) !!}
          </div>
          
        <div class="form-row">
          <div class="col">
            {!! Form::label('preco_un', 'Preço unitário') !!}
            {!! Form::text('preco_un', null, ['class'=>'form-control', 'id'=>'valor', 'step' => 'any', 'onkeyup'=>"formatarMoeda()", 'placeholder'=>'R$', 'required']) !!}
          </div>

          <div class="col">
              {!! Form::label('marca', 'Marca') !!}
              {!! Form::text('marca', null, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>
        <br>
        
        <div class="form-group">
          {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
          <a href="{{ route('produtos', []) }}" class="btn btn-danger">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
    </div>
  </div>
@stop

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

        if (valor.length > 6) {
            valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }

        elemento.value = valor;
        if(valor == 'NaN') elemento.value = '';
    }
</script>