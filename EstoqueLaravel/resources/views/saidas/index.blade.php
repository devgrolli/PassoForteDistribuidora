<!-- blade: sistema de template simples -->
@extends('layouts.default')
@section('content')
    <script src="{{ asset('js/loading.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="col-xxl-4 col-xl-12 mb-4">
        <div class="card h-100">
            <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                <div class="col-xl-8 col-xxl-12">
                    <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                        <h1 class="text-primary">Saídas de Produtos</h1>
                        <p class="text-gray-700 mb-0">
                            Lista de todas as saídas de produto do estoque!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.alerts')

    <div class="card mb-4">
        <div class="card-body">
            <div class="datatable">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="btn-group" role="group" aria-label="Exemplo básico">
                                <a href="{{ route('saidas.create', []) }}" type="button" class="btn btn-padrao1">Cadastrar
                                    <i class="bi bi-cart-dash-fill"></i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-cart-dash-fill" viewBox="0 0 20 20">
                                        <path
                                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z" />
                                    </svg>
                                </a>
                                <a href="{{ route('tipo_saidas.create', []) }}" type="button"
                                    class="btn btn-padrao2">Cadastrar Tipo de Saídas
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                            </div><br><br>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_filter"> </div>
                        </div>
                    </div>

                    <table class="table table-hover" id="table">
                        <thead class="letra" id="thead_colors" >
                            <th></th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Data da saída</th>
                            <th></th>
                        </thead>

                        <tbody>
                            @foreach ($saidas as $saida)
                                <tr>
                                    <td></td>
                                    <td>{{ $saida->produto->nome }}</td>
                                    <td>{{ $saida->quantidade }} </td>
                                    <td>R$ {{ number_format($saida->preco_un, 2, ',', '.') }}</td>
                                    <td>{{ Carbon\Carbon::parse($saida->created_at)->format('d/m/Y - H:i:s') }}</td>
                                    {{-- <td>{{ $s->tipo_saidas->nome }}</td> --}}
                                    <td>
                                        <a href="{{ route('saidas.edit', ['id' => \Crypt::encrypt($saida->id)]) }}"
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
                                        <a href="#" onclick="return ConfirmaExclusao({{ $saida->id }})"
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
                    {{ $saidas->links() }}
                </div>
            </div>
        </div>
    </div>

@stop
@section('table-delete')
    "saidas"
@endsection
