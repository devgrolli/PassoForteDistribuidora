@extends('layouts.default')
@section('content')
    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="col-xxl-4 col-xl-12 mb-4">
        <div class="card h-100">
            <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                <div class="col-xl-8 col-xxl-12">
                    <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                        <h1 class="text-primary">Clientes</h1>
                        <p class="text-gray-700 mb-0">
                            Lista de todos os clientes!
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
                                        <div class="form-group col-12">
                                            <div class="btn-group float-sm-left" role="group" aria-label="Exemplo básico">
                                                <a href="{{ route('clientes.create', []) }}" type="button" class="btn btn-padrao1">
                                                    Cadastrar <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('tipo_clientes.create', []) }}" type="button" class="btn btn-padrao2">Cadastrar Tipo de Cliente <i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    <a href="{{ route('excel') }}" type="button" class="btn btn-padrao1"> Exportar PDF <i class="bi bi-file-earmark-excel-fill"></i>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68L8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                                                    </svg>
                                                </a>    
                                            </div>
                                        </div>      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            {!! Form::open(['name' => 'form_name', 'route' => 'fornecedores']) !!}
                            <div class="input-group mb-8">
                                <input type="text" class="form-control-padrao1" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-padrao1" type="submit" name="search"
                                        type="button" id="search-btn"><i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <table class="table table-hover" id="table">
                        <thead class="letra" id="thead_colors">
                            <th></th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Endereço</th>
                            <th>Tipo de Cliente</th>
                            <td></td>
                        </thead>

                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td></td>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ $cliente->telefone }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->endereco }}</td>
                                    @switch( $cliente->categoria_cliente )
                                        @case( 1 )
                                            <td style="color:rgb(43, 184, 0)"><strong>{{ $cliente->tipo_cliente->nome }} <i class="bi bi-emoji-smile-fill"></i></strong>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>
                                                </svg>
                                            </td>
                                        @break
                                        @case(3)
                                            <td style="color:rgb(230, 8, 0)"><strong>{{ $cliente->tipo_cliente->nome }} <i class="bi bi-emoji-frown-fill"></i></strong>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>
                                                </svg>
                                            </td>
                                        @break
                                        @case(4)
                                            <td style="color:rgb(255, 166, 0)"><strong>{{ $cliente->tipo_cliente->nome }} <i class="bi bi-emoji-neutral-fill"></i></strong>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-neutral-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-3 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>
                                                </svg>
                                            </td>
                                        @break
                                    @endswitch

                                    <td>
                                        <a href="{{ route('clientes.edit', ['id' => \Crypt::encrypt($cliente->id)]) }}"
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
                                        <a href="#" onclick="return ConfirmaExclusao({{ $cliente->id }})"
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
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@stop
@section('table-delete')
    "clientes"
@endsection
