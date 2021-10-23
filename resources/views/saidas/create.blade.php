@section('content')
  @extends('layouts.default') 
  @include('sweetalert::alert')
  @include('layouts.formata_moeda')
  @include('layouts.dynamic_validade')
  @include('layouts.estoque_modal')
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
          {!! Form::open(['route' => 'saidas.store']) !!}
          <div class="form-row">
            <div class="col">
              {!! Form::Label('produto_id', 'Produto') !!}
              <select class="selectpicker form-control select_search" id="produto_nome" data-live-search="true" name="produto_id" required>
                <option value="">Selecione um Produto</option>
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
              {!! Form::text('preco_un', null, ['class'=>'form-control', 'id'=>'preco_un', 'placeholder'=>'R$', 'readonly']) !!}
            </div>
            <div class="col">
              {!! Form::label('preco_saida', 'Preço Saída') !!}
              {!! Form::text('preco_saida', null, ['class'=>'form-control', 'id'=>'valor', 'onkeyup'=>"formatarMoeda()", 'placeholder'=>'R$', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::label('quantidade', 'Quantidade') !!}
              {!! Form::number('quantidade', null, ['class'=>'form-control', 'required', 'pattern' => '[0-9]+([,\.][0-9]+)?']) !!}
            </div>
            <div class="col">
              {!! Form::label('tipo_saidas_id', 'Tipo de saída') !!}
              {!! Form::select('tipo_saidas_id', \App\TipoSaida::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class'=>'form-control select_search', 'required']) !!}
            </div>
          </div>
          <br>

          <div class="form-group">
            {!! Form::label('observacoes', 'Observações') !!}
            {!! Form::textarea('observacoes', null, ['class'=>'form-control', 'id'=>'cal']) !!}
          </div>
          <div class="form-group">
            <a href="{{ route('saidas', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
            {!! Form::button('Salvar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
          </div>
        {!! Form::close() !!} 
      </div>
    </div>
  </div>
@stop