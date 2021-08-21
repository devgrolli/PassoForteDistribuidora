@section('content')
  @extends('layouts.default') 
  @include('sweetalert::alert')
  @include('layouts.formata_moeda')
  @include('layouts.dynamic_validade')
  @extends('layouts.select_search')
  @include('layouts.spinner')

  <link rel="stylesheet" type="text/css" href="../css/default-template.css">
  <div id="div_create">
    <div class="card">
      <div class="card-header">
        <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
          <strong>
            <h1 class="text-create">Saída de Produtos
              <button class="btn btn-padrao2" type="button" data-toggle="modal" data-target="#exampleModal"> Visualizar estoque <i class="fa fa-search"></i></button>
            </h1>
          </strong>
        </div>
      </div>
        <div class="card-body" id="card_crud">
          {!! Form::open(['route'=> ["saidas.update", 'id'=>$saida->id], 'method'=>'put']) !!}
          <div class="form-row">
            <div class="col">
              {!! Form::Label('produto_id', 'Produto') !!}
              <select class="selectpicker form-control select_search" id="produto_nome" data-live-search="true" name="produto_id" required>
                  @foreach($products as $p)
                    <option value="{{$p->id}}">{{$p->nome}}</option>
                  @endforeach
              </select>
            </div>

            <div class="col">
              {!! Form::label('validade_produto', 'Validade do Produto') !!}
              <select name="validade_produto" class="form-control select_search" id="validade_produto" required>
                <option></option>
              </select>
            </div>
            <div class="col">
              {!! Form::label('preco_un', 'Preço Entrada') !!}
              {!! Form::text('preco_un', $saida->preco_un, ['class'=>'form-control', 'id'=>'preco_un', 'placeholder'=>'R$', 'readonly']) !!}
            </div>
            <div class="col">
              {!! Form::label('preco_saida', 'Preço Saída') !!}
              {!! Form::text('preco_saida', $saida->preco_saida, ['class'=>'form-control', 'id'=>'valor', 'placeholder'=>'R$', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('quantidade', 'Quantidade') !!}
              {!! Form::number('quantidade', $saida->quantidade, ['class'=>'form-control', 'required', 'pattern' => '[0-9]+([,\.][0-9]+)?']) !!}
            </div>
            <div class="col">
              {!! Form::label('tipo_saidas_id', 'Tipo de saída') !!}
              {!! Form::select('tipo_saidas_id', \App\TipoSaida::orderBy('nome')->pluck('nome', 'id')->toArray(), $saida->tipo_saidas_id, ['class'=>'form-control select_search', 'required']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('observacoes', 'Observações') !!}
            {!! Form::textarea('observacoes', $saida->observacoes, ['class'=>'form-control', 'id'=>'cal']) !!}
          </div>
          <div class="form-group">
            <a href="{{ route('saidas', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
            {!! Form::button('Salvar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
          </div>
        {!! Form::close() !!} 
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Estoque</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <table class="table table-hover" id="table">
            <thead class="letra" id="thead_colors">
              <th></th>
              <th>Nome</th>
              <th>Quantidade</th>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="tableDefaultCheck1">
                      <label class="custom-control-label" for="tableDefaultCheck1"></label>
                    </div>
                  </td>
                  <td>{{ $product->nome }}</td>
                  <td>{{ $product->quantidade }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <button type="button" value="selectAll" class="main" onclick="checkAll()">Select All</button>
          <button type="button" value="deselectAll" class="main" onclick="uncheckAll()">Clear</button>
        </div>
      </div>
    </div>
  </div>
@stop