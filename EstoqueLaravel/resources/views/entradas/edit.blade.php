@extends('layouts.default')
@section('content')

  <link rel="stylesheet" type="text/css" href="css/buttons.css">
  @if($errors->any()) <!-- existe algum erro neste array? -->
    <ul class="alert alert-danger"> 
      @foreach($errors-all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <div class="card">
    <div class="card-header div-header-form" style="background: rgb(52, 58, 64)">
      <h3 style="color:rgb(255, 255, 255)"><strong>Editando Entrada de Produtos</strong></h3>
    </div>

    <div class="card-body">
      {!! Form::open(['route'=> ["entradas.update", 'id'=>$entrada->id], 'method'=>'put']) !!}
        <div class="form-group">
          {!! Form::label('produto_id', 'Produto') !!}
          {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                $entrada->produto_id, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::text('quantidade', $entrada->quantidade, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('preco_un', 'Preço') !!}
            {!! Form::text('preco_un', $entrada->preco_un, ['class'=>'form-control', 'id'=>'valor', 'onkeyup'=>"formatarMoeda()", 'placeholder'=>'R$','required']) !!}
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            {!! Form::label('fornecedor_id', 'Fornecedor') !!}
            {!! Form::select('fornecedor_id', \App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(), 
                                                $entrada->fornecedor_id, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('tipo_entrada_id', 'Tipo de entrada') !!}
            {!! Form::select('tipo_entrada_id', \App\TipoEntrada::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                  $entrada->tipo_entrada_id, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('data_entrada', 'Data de Entrada') !!}
          {!! Form::date('data_entrada', $entrada->data_entrada, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('observacoes', 'Observações') !!}
          {!! Form::textarea('observacoes', $entrada->observacoes, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Salvar', ['class'=>'btn btn-padrao1']) !!}
          <a href="{{ route('entradas', []) }}" class="btn btn-padrao2">Cancelar</a>
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