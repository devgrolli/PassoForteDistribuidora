@extends('layouts.default')
@section('content')
    {{-- <h1>Tipo de Entradas</h1> --}}
    <link rel="stylesheet" type="text/css" href="css/default-template.css">

    @include('layouts.label')

    @include('layouts.alerts')

    <div class="card mb-4">
        <div class="card-body">
            <div class="datatable">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length">
                                <a href="{{ route('tipo_entradas.create', []) }}"
                                    class="btn btn-padrao1">Cadastrar</a><br></br>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_filter"> </div>
                        </div>
                    </div>

                    <table class="table table-hover" id="table">
                        <thead class="letra" id="thead_colors">
                            <th></th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th></th>
                        </thead>

                        <tbody>
                            @foreach ($tipo_entradas as $tipo_entrada)
                                <tr>
                                    <td></td>
                                    <td>{{ $tipo_entrada->nome }}</td>
                                    <td>{{ $tipo_entrada->descricao }}</td>
                                    <td>
                                        <a href="{{ route('tipo_entradas.edit', ['id' => \Crypt::encrypt($tipo_entrada->id)]) }}"
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
                                        <a href="#" onclick="return ConfirmaExclusao({{ $tipo_entrada->id }})"
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
                    {{ $tipo_entradas->links() }}
                </div>
            </div>
        </div>
    </div>

@stop
@section('table-delete')
    "tipo_entradas"
@endsection
