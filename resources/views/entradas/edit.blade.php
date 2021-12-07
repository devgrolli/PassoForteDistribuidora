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
                    <h1 class="text-create"><strong>Cadastro Entrada de Produtos <button class="btn btn-padrao2" type="button" data-toggle="modal" data-target="#exampleModalEstoque">Visualizar estoque <i class="fa fa-search"></i></button></h1></strong>
                </div>
            </div>

            <div class="card-body" id="card_crud">
                {!! Form::open(['route' => ['entradas.update', 'id' => $entrada->id], 'method' => 'put']) !!}
                <div class="form-row">
                    <div class="col">
                        {!! Form::label('produto_id', 'Produto') !!}
                        {!! Form::select('produto_id', \App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                      $entrada->produto_id,['class' => 'form-control select_search', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('quantidade', 'Quantidade') !!}
                        {!! Form::number('quantidade', $entrada->quantidade, ['class' => 'form-control', 'required', 'pattern' => '[0-9]+([,\.][0-9]+)?']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('preco_un', 'Preço Unitário') !!}
                        {!! Form::text('preco_un', null, ['class' => 'form-control preco_un', 'id' => 'valor', 'onkeyup' => 'formatarMoeda()', 'placeholder' => 'R$', 'required']) !!}
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="col">
                        {!! Form::label('validade', 'Validade') !!}
                        {!! Form::date('validade', $entrada->validade, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('fornecedor_id', 'Fornecedor') !!}
                        {!! Form::select('fornecedor_id',\App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(),
                                                          $entrada->fornecedor_id,['class' => 'form-control select_search', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('tipo_entrada_id', 'Tipo de entrada') !!}
                        {!! Form::select('tipo_entrada_id',\App\TipoEntrada::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                          $entrada->tipo_entrada_id, ['class' => 'form-control select_search', 'required']) !!}
                    </div>
                </div><br>

                <div class="form-group">
                    {!! Form::label('observacoes', 'Observações') !!}
                    {!! Form::textarea('observacoes', $entrada->observacoes, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <a href="{{ route('entradas', []) }}" class="btn btn-padrao2 btn-cancelar-entrada">Cancelar <i class="fas fa-ban"></i></a>
                    {!! Form::button('salvar <i class="far fa-save"></i>', ['class' => 'btn btn-padrao1 btn-cadastrar-entrada', 'type' =>'submit']) !!} 
                </div>
                {!! Form::close() !!}
                <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
            </div>
        </div>
    </div>
    @include('modals.modal_estoque')
@stop

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
  $(document).ready(function() {
    var preco_entrada = ({{ $entrada->preco_un }}).toLocaleString('pt-br', {minimumFractionDigits: 2});
    $('#valor').val(preco_entrada);
  });
</script>