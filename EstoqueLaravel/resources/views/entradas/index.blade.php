@extends('layouts.default')
@section('content')

    <h1>Entradas</h1>
    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="btn-group" role="group" aria-label="Exemplo básico">
        <a href="{{ route('entradas.create', []) }}" type="button" class="btn btn-padrao1">Cadastrar 
            <i class="bi bi-cart-plus-fill"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 20 20">
                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
            </svg>
        </a>
        <a href="{{ route('tipo_entradas.create', []) }}" type="button" class="btn btn-padrao2">Cadastrar Tipo de Entrada 
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div><br><br>

    @include('layouts.alerts')

    <table class="table table-hover" id="table">
        <thead>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço UN</th>
            <th>Fornecedor</th>
            <th>Data Entrada</th>
            <th>Tipo de Entrada</th>
            <td></td>
        </thead>

        <tbody>
            @foreach ($entradas as $entrada)
                <tr>
                    <td>{{ $entrada->produto->nome }}</td>
                    <td> {{ $entrada->quantidade }}</td>
                    <td>R$ {{ number_format($entrada->preco_un, 2, ',', '.') }}</td>
                    <td>{{ $entrada->fornecedor->razao_social }}</td>
                    <td>{{ Carbon\Carbon::parse($entrada->created_at)->format('d/m/Y - H:i:s') }}</td>
                    <td>{{ $entrada->tipo_entrada->nome }}</td>
                    <td>
                        <a href="{{ route('entradas.edit', ['id' => \Crypt::encrypt($entrada->id)]) }}"
                            class="btn btn-padrao1-icons">
                            <i class="bi bi-pencil-square"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>

                        </a>
                        <a href="#" onclick="return ConfirmaExclusao({{ $entrada->id }})" class="btn btn-padrao2-icons">
                            <i class="bi bi-archive">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-archive" viewBox="0 0 16 16">
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
    {{ $entradas->links() }}

@stop
@section('table-delete')
    "entradas"
@endsection
