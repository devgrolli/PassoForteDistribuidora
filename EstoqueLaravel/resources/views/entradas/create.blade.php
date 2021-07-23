@extends('layouts.default')

@section('content')

    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div id="div_create">
        @include('layouts.spinner')
        <div class="card">
            <div class="card-header">
                <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                    <h1 class="text-create"><strong>Cadastro Entrada de Produtos
                            <button class="btn btn-padrao2" type="button" data-toggle="modal" data-target="#exampleModal">
                                Visualizar estoque <i class="fa fa-search"></i></button></strong></strong>
                    </h1>
                </div>
            </div>

            <div class="card-body" id="card_crud">
                {!! Form::open(['route' => 'entradas.store']) !!}

                <div class="form-row">
                    <div class="col">
                        {!! Form::label('produto_id', 'Produto') !!}
                        {!! Form::select('produto_id',\App\Produto::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                      null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('quantidade', 'Quantidade') !!}
                        {!! Form::number('quantidade', null, ['class' => 'form-control', 'required', 'pattern' => '[0-9]+([,\.][0-9]+)?']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('preco_un', 'Preço Unitário') !!}
                        {!! Form::text('preco_un', null, ['class' => 'form-control', 'id' => 'valor', 'onkeyup' =>
                                       'formatarMoeda()', 'placeholder' => 'R$', 'required']) !!}
                    </div>
                </div><br>

                <div class="form-row">
                    <div class="col">
                        {!! Form::label('validade', 'Validade') !!}
                        {!! Form::date('validade', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('fornecedor_id', 'Fornecedor') !!}
                        {!! Form::select('fornecedor_id',\App\Fornecedor::orderBy('razao_social')->pluck('razao_social', 'id')->toArray(),
                                                        null,['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('tipo_entrada_id', 'Tipo de entrada') !!}
                        {!! Form::select('tipo_entrada_id',\App\TipoEntrada::orderBy('nome')->pluck('nome', 'id')->toArray(),
                                                          null,['class' => 'form-control', 'required']) !!}
                    </div>
                </div><br>

                <div class="form-group">
                    {!! Form::label('observacoes', 'Observações') !!}
                    {!! Form::textarea('observacoes', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                  {!! Form::button('Cadastrar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1 btn-cadastrar-entrada', 'type'=>'submit']) !!}
                  <a href="{{ route('entradas', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
                </div>
                {!! Form::close() !!}
                <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estoque</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table table-hover" id="table">
                        <thead class="letra" id="thead_colors">
                            <th>Nome</th>
                            <th>Quantidade</th>
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
    @include('sweetalert::alert')
    @include('layouts.formata_modea')
@stop