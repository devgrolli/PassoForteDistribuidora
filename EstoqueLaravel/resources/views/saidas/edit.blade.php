@extends('layouts.default')
@section('content')

    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div class="card">
      <div class="card-header" style="background: rgb(52, 58, 64)">
        <h3 style="color:rgb(255, 255, 255)"><strong>Editando Saída de Produtos</strong></h3>
      </div>

       <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
        {!! Form::open(['route'=> ["saidas.update", 'id'=>$saida->id], 'method'=>'put']) !!}
        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Visualizar estoque
        </button>
        <div class="form-row">
          <div class="col">
            {!! Form::label('produto_id', 'Produto') !!}
            {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                  $saida->produto_id, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::number('quantidade',  $saida->quantidade, ['class'=>'form-control', 'required', 'pattern' => '[0-9]+([,\.][0-9]+)?']) !!}
          </div>
          <div class="col">
            {!! Form::label('preco_un', 'Preço Unitário') !!}
            {!! Form::text('preco_un', $saida->preco_un, ['class'=>'form-control', 'id'=>'valor', 'onkeyup'=>"formatarMoeda()", 'placeholder'=>'R$', 'required']) !!}
          </div>
        </div>

        <div class="form-row">
          {!! Form::label('tipo_saidas_id', 'Tipo da Saída') !!}
          {!! Form::select('tipo_saidas_id', \App\TipoSaida::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                      $saida->tipo_saidas_id, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('observacoes', 'Observações') !!}
          {!! Form::textarea('observacoes', $saida->observacoes, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Salvar', ['class'=>'btn btn-padrao1']) !!}
          <a href="{{ route('saidas', []) }}" class="btn btn-padrao2">Cancelar</a>
        </div>
      {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
    </div>
	</div>
  @include('sweetalert::alert')
  @include('layouts.formata_moeda')
@stop