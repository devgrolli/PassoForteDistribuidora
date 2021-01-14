@extends('layouts.default')

@section('content')
    @include('layouts.alerts')
    <div class="card">
      <link rel="stylesheet" type="text/css" href="css/default-template.css">
      <div class="card-header" style="background: rgb(52, 58, 64)">
        <h3 style="color:rgb(255, 255, 255)"><strong>Cadastro Entrada de Produtos</strong></h3>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Produtos em Cadastrados</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <table class="table table-hover" id="table">
                <thead>
                    <th>Nome</th>
                    <th>Estoque</th>
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
  
      <div class="card-body">
        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Visualizar produtos
        </button>
        {!! Form::open(['route'=>'entradas.store']) !!}
        <div class="form-row">
          <div class="col">
            {!! Form::label('produto_id', 'Produto') !!}
            {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                  null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('quantidade', 'Quantidade') !!}
              {!! Form::number('quantidade', null, ['class'=>'form-control', 'required']) !!}
            
          </div>
          </div>

          <div class="form-row">
            <div class="col">
              {!! Form::label('preco_un', 'Preço Unitário') !!}
              {!! Form::text('preco_un', null, ['class'=>'form-control', 'id'=>'valor', 'onkeyup'=>"formatarMoeda()", 'placeholder'=>'R$', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('fornecedor_id', 'Fornecedor') !!}
              {!! Form::select('fornecedor_id', \App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(), 
                                                  null, ['class'=>'form-control', 'required']) !!}
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              {!! Form::label('tipo_entrada_id', 'Tipo de entrada') !!}
              {!! Form::select('tipo_entrada_id', \App\TipoEntrada::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                    null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('data_entrada', 'Data de Entrada') !!}
              {!! Form::date('data_entrada', null, ['class'=>'form-control', 'required']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('observacoes', 'Observações') !!}
            {!! Form::textarea('observacoes', null, ['class'=>'form-control', 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
            <a href="{{ route('entradas', []) }}" class="btn btn-danger">Cancelar</a>
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
 