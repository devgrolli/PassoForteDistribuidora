@extends('layouts.default')
@section('content')
    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="config-space-divs">
        <div class="col-xxl-4 col-xl-12 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                    <div class="col-xl-8 col-xxl-12">
                        <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                            <h1 class="text-primary">Produtos <i class="fas fa-fw fal fa-qrcode"> </i></h1>
                            <p class="text-gray-700 mb-0">
                                Lista de todos os produtos cadastrados!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="datatable">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="btn-group mr-2">               
                                <div class="form-group col-12">
                                    <div class="btn-group" role="group" aria-label="Exemplo básico">
                                        <button type="button" class="btn btn-padrao1-div_table" data-toggle="modal" data-target="#cadastro">
                                            Cadastrar <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn-padrao2-div_table" data-toggle="modal" data-target="#excelModal">
                                            Exportar <i class="fas fa-file-export"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 ">
                                {!! Form::open(['name' => 'form_name', 'route' => 'produtos']) !!}
                                    <div class="input-group mb-8 div-group-align">
                                        <input type="text" name="desc_filtro" class="form-control-padrao1-div_table" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-padrao1-div_table" type="submit" name="search"
                                                type="button" id="search-btn"><i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <br>

                        <table class="table table-hover" id="table">
                            <thead class="letra" id="thead_colors" align="center" style="margin: 0px auto;">
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Unidade</th>
                                <th>Marca</th>
                                <th>Categoria</th>
                                <th>Data do cadastro</th>
                                </th>
                                <td></td>
                            </thead>

                            <tbody align="center" style="margin: 0px auto;">
                                @foreach ($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->id }}</td>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->unidade }}</td>
                                        <td>{{ $produto->marca }}</td>
                                        <td>{{ $produto->categorias->nome }}</td>
                                        <td>{{ Carbon\Carbon::parse($produto->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <button data-toggle="modal" data-target='#editModal' onclick="editarModal('{{ $produto->id }}');"
                                                class="btn btn-padrao1-icons edit-tipo">
                                                <i class="bi bi-pencil-square"></i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </button>
                                            <a href="#" onclick="return ConfirmaExclusao({{ $produto->id }})" 
                                   
                                                class="btn btn-padrao2-icons">
                                                <i class="bi bi-archive">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                                    </svg>
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $produtos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header color-header-modal">
                    <h5 class="modal-title" id="exampleModalLongTitle">Filtre a Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => ['export', 'type'=> 'produtos']]) !!}
                    <div class="modal-body">
                        {!! Form::label('start_date', 'Data Inicial', ['class'=>'letras']) !!}
                        {!! Form::date('start_date', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="modal-body">
                        {!! Form::label('end_date', 'Data Final') !!}
                        {!! Form::date('end_date', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="modal-body">
                        {!! Form::Label('type_doc', 'Tipo de Documento') !!}
                        <select class="selectpicker form-control select_search" name="type_doc" id="type_doc" data-live-search="true" required>
                            <option value="1">Excel</option>
                            <option value="2">PDF</option>
                        </select>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-padrao2-div_table" data-dismiss="modal">Fechar <i class="fas fa-times-circle"></i></button>
                        {!! Form::button('Baixar <i class="fa fa-download" aria-hidden="true"></i>',['class'=>'btn btn-padrao1 btn-cadastrar-entrada', 'type'=>'submit']) !!}
                        {{-- <a href="{{ route('entradas.export', ['type' => 'entradas']) }}" type="button" class="btn btn-padrao1-div_table"> 
                            Baixar <i class="fas fa-download"></i>
                        </a> --}}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header color-header-modal">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="crud-alignment-modal">
                    {!! Form::open(['route' => 'produtos.store']) !!}
                    <div class="modal-body">
                        {!! Form::label('id', 'Código') !!}
                        {!! Form::number('id', null, ['class' => 'form-control id-div', 'required']) !!}
                    </div>
                    <div class="modal-body">
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="modal-body">
                        {!! Form::label('unidade', 'Unidade') !!}
                        {!! Form::text('unidade', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="modal-body">
                        {!! Form::label('marca', 'Marca') !!}
                        {!! Form::text('marca', null, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="modal-body">
                        {!! Form::label('categorias_id', 'Categorias') !!}
                        {!! Form::select('categorias_id', \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class'=>'form-control select_search', 'required']) !!}
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-padrao2-div_table" data-dismiss="modal">Cancelar <i class="fas fa-times-circle"></i></button>
                    {!! Form::button('Cadastrar <i class="far fa-save"></i>', ['class' => 'btn btn-padrao1 btn-cadastrar-entrada', 'type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header color-header-modal">
                    <h5 class="modal-title" id="exampleModalLongTitle">Alteração de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="crud-alignment-modal">
                    {!! Form::open(['route'=> "produtos.update", 'method'=>'put']) !!}
                    <div class="modal-body">
                        {!! Form::label('id', 'Código') !!}
                        {!! Form::number('id', null, ['class' => 'form-control id-div', 'readonly']) !!}
                    </div>
                    <div class="modal-body">
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::text('nome', null, ['class' => 'form-control nome-div', 'required']) !!}
                    </div>
                    <div class="modal-body">
                        {!! Form::label('unidade', 'Unidade') !!}
                        {!! Form::text('unidade', null, ['class'=>'form-control un-div', 'required']) !!}
                    </div>
                    <div class="modal-body">
                        {!! Form::label('marca', 'Marca') !!}
                        {!! Form::text('marca', null, ['class'=>'form-control marca-div', 'required']) !!}
                    </div>
                    <div class="modal-body">
                        {!! Form::label('categorias_id', 'Categorias') !!}
                        {!! Form::select('categorias_id', \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class'=>'form-control select_search', 'required']) !!}
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-padrao2-div_table" data-dismiss="modal">Cancelar <i class="fas fa-times-circle"></i></button>
                    {!! Form::button('Salvar <i class="far fa-save"></i>', ['class' => 'btn btn-padrao1 btn-cadastrar-entrada', 'type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
    </div>
    @include('sweetalert::alert')
    @include('layouts.spinner')
@stop
@section('table-delete')
    "produtos"
@endsection
