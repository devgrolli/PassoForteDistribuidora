<!-- blade: sistema de template simples -->
@extends('layouts.default')
@section('content')
    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="config-space-divs">
        <div class="col-xxl-4 col-xl-12 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                    <div class="col-xl-8 col-xxl-12">
                        <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                            <h1 class="text-primary">Fornecedores <i class="fas fa-fw fal fa-truck"> </i></h1>
                            <p class="text-gray-700 mb-0">
                                Lista de todos os fornecedores cadastrados!
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
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length">
                                    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar com grupos de botões">
                                        <div class="btn-group mr-2" role="group" aria-label="Primeiro grupo">
                                            <div class="btn-toolbar mb-3" role="toolbar"
                                                aria-label="Toolbar com grupos de botões">
                                                <div class="btn-group mr-2" role="group" aria-label="Primeiro grupo">
                                                    <div class="btn-group float-sm-left" role="group" aria-label="Exemplo básico">
                                                        <a href="{{ route('fornecedores.create', []) }}" class="btn btn-padrao1-div_table">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></a>
                                                        <a href="{{ route('pedidos', []) }}" type="button" class="btn btn-padrao2-div_table">Pedido fornecedor <i class="fa fa-table" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>

                                                {!! Form::open(['name' => 'form_name', 'route' => 'fornecedores']) !!}
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control-padrao1-div_table" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-padrao1-div_table" type="submit" name="search" type="button" id="search-btn"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover" id="table">
                            <thead class="letra" id="thead_colors">
                                <th></th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Endereço</th>
                                <th>Bairro</th>
                                <th>Telefone</th>
                                <td></td>
                            </thead>

                            <tbody>
                                @foreach ($fornecedores as $fornecedor)
                                    <tr>
                                        <td></td>
                                        <td>{{ $fornecedor->razao_social }}</td>
                                        <td>{{ $fornecedor->email }}</td>
                                        <td>{{ $fornecedor->endereco }}</td>
                                        <td>{{ $fornecedor->bairro }}</td>
                                        <td>{{ $fornecedor->telefone }}</td>
                                        <td>
                                            <a href="{{ route('fornecedores.edit', ['id' => \Crypt::encrypt($fornecedor->id)]) }}"
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
                                            <a href="#" onclick="return ConfirmaExclusao({{ $fornecedor->id }})"
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
                        {{ $fornecedores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@stop
@section('table-delete')
    "fornecedores"
@endsection
