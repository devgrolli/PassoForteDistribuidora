@extends('layouts.default')
@section('content')
@include('layouts.spinner')
    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="config-space-divs">
        <div class="col-xxl-4 col-xl-12 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                    <div class="col-xl-8 col-xxl-12">
                        <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                            <h1 class="text-primary">Produtos <i class="fas fa-fw fal fa-barcode"> </i></h1>
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
                            <div class="btn-group" role="group" aria-label="Exemplo básico">
                                <a href="{{ route('produtos.create', []) }}" id="btn-cadastrar-produto" type="button" class="btn btn-padrao1-div_table">Cadastrar
                                    <i class="fa fa-plus" aria-hidden="true"></i></a>
                                </a>
                                <button class="btn dropdown-toggle btn-padrao2-div_table" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Documentos 
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">PDF <i class="fas fa-file-pdf iten-icon-pdf"></i></a>
                                    <a class="dropdown-item" href="{{ route('produtos.export', ['type' => 'produtos']) }}"> 
                                        Exportar excel  <i class="fas fa-file-export iten-icon-excel"></i> 
                                    </a>
                                    <a class="dropdown-item" href="#">
                                    Importar excel <i class="fas fa-file-import iten-icon-excel"></i>
                                    </a>
                                </div>
                            </div>
                    
                            <div class="col-sm-12 col-md-4">
                                {!! Form::open(['name' => 'form_name', 'route' => 'produtos']) !!}
                                <div class="input-group mb-8">
                                    <input type="text" class="form-control-padrao1-div_table" aria-describedby="basic-addon2">
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
                                        <td>
                                            <a href="{{ route('produtos.edit', ['id' => \Crypt::encrypt($produto->id)]) }}"
                                                class="btn btn-padrao1-icons">
                                                <i class="bi bi-pencil-square"></i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>

                                            </a>
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
    @include('sweetalert::alert')
@stop
@section('table-delete')
    "produtos"
@endsection
