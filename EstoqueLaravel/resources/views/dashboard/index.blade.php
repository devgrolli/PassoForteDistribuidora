@extends('layouts.default')
@section('content')
    @include('layouts.spinner')
    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
    <h7 class="display-4 dashtext d-none d-sm-block ">
        Dashboard
    </h7>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-entrada shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6>
                                    Total de Entradas</h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$
                                {{ number_format($saldo_entrada, 2, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('entradas', []) }}">
                                <lord-icon src="https://cdn.lordicon.com//uetqnvvg.json" trigger="loop"
                                    colors="primary:#173820,secondary:#173820" stroke="71" style="width:70PX;height:70PX">
                                </lord-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-saida shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6>Total de Saídas</h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$
                                {{ number_format($saldo_saida, 2, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('saidas', []) }}">
                                <lord-icon src="https://cdn.lordicon.com//krmfspeu.json" trigger="loop"
                                    colors="primary:#4c5253,secondary:#4c5253" stroke="80" style="width:70px;height:70px">
                                </lord-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-estoque shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6>Produtos com estoque baixo</h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $estoque_baixo[1] }}</div>
                        </div>
                        <div class="col-auto">
                            <button class="btn " type="button" data-toggle="modal" data-target="#exampleModal">
                                <lord-icon src="https://cdn.lordicon.com//tdrtiskw.json" trigger="loop"
                                    colors="primary:#0a4e5c,secondary:#0a4e5c" stroke="80" style="width:70px;height:70px">
                                </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-cliente shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6>Total de Clientes</h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_clientes }}</div>
                        </div>

                        <div class="col-auto">
                            <a href="{{ route('clientes', []) }}">
                                <lord-icon src="https://cdn.lordicon.com//uukerzzv.json" trigger="loop"
                                    colors="primary:#ff5e32,secondary:#000000" stroke="80" style="width:70px;height:70px">
                                </lord-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-caixa shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6>Total de Prejuízo </h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-red-800">
                                @if (is_array($balanco_caixa[0]) == true)
                                    R$ {{ number_format($balanco_caixa[0][0], 2, ',', '.') }}
                                @else
                                    R$ {{ number_format($balanco_caixa[0], 2, ',', '.') }}
                                @endif
                            </div>
                        </div>

                        <div class="col-auto">
                            <button class="btn" type="button" data-toggle="modal" data-target="#exampleModalPrejuizo">
                                <svg viewBox="0 0 24 24" width="70" height="70" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <style>
                                        @keyframes downit {
                                            0% {
                                                opacity: 0;
                                                transform: translate(0, -4px) scaleX(.9) scaleY(.9)
                                            }

                                            25% {
                                                opacity: 1;
                                                transform: translate(0, 2px) scaleX(.7) scaleY(.7)
                                            }

                                            to {
                                                opacity: 0;
                                                transform: translate(0, 2px) scaleX(1) scaleY(1)
                                            }
                                        }

                                    </style>
                                    <circle cx="12" cy="12" r="8.5" stroke="#FF0000" />
                                    <path
                                        d="M12.5 8a.5.5 0 00-1 0h1zm-1 7.2a.5.5 0 001 0h-1zm-2.146-2.754a.5.5 0 00-.708.708l.708-.708zM12 15.8l-.354.354a.5.5 0 00.708 0L12 15.8zm3.354-2.646a.5.5 0 00-.708-.708l.708.708zM11.5 8v7.2h1V8h-1zm-2.854 5.154l3 3 .708-.708-3-3-.708.708zm3.708 3l3-3-.708-.708-3 3 .708.708z"
                                        fill="#FF0000"
                                        style="animation:downit cubic-bezier(.9,-.32,0,1.56) 1.5s infinite;transform-origin:50% 50%" />
                                </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-caixa shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6>Total de Lucro </h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if (is_array($balanco_caixa[1]) == true)
                                    R$ {{ number_format($balanco_caixa[1][0], 2, ',', '.') }}
                                @else
                                    R$ {{ number_format($balanco_caixa[1], 2, ',', '.') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="btn" type="button" data-toggle="modal" data-target="#exampleModalLucro">
                                <lord-icon src="https://cdn.lordicon.com//gqdnbnwt.json" trigger="loop"
                                    colors="primary:#eeca66,secondary:#eeca66" stroke="80" style="width:70px;height:70px">
                                </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-produtos shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6>Produtos cadastrados</h6>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_produtos }}</div>
                        </div>
                        <div class="col-auto">
                            <lord-icon src="https://cdn.lordicon.com//slkvcfos.json" trigger="loop"
                                colors="primary:#f8efbe,secondary:#f8efbe" stroke="80" style="width:70PX;height:70PX">
                            </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($data_expirada[1] > 0)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-dash border-left-vencimento shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <h6>Produtos com Validade expirada</h6>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_expirada[1] }}</div>
                            </div>
                            <div class="col-auto">
                                <button class="btn " type="button" data-toggle="modal" data-target="#exampleModalExpirado">
                                    <lord-icon src="https://cdn.lordicon.com//tvyxmjyo.json" trigger="loop"
                                        colors="primary:#0cf29d,secondary:#000000" stroke="80"
                                        style="width:70px;height:70px">
                                    </lord-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Estoque baixo-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estoque baixo
                        <a href="{{ route('entradas.create', []) }}" class="btn btn-padrao1">Cadastrar entradas</a>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table table-hover" id="table">
                        <thead class="letra" id="thead_colors">
                            <th>Nome</th>
                            <th>Estoque</th>
                        </thead>
                        <tbody>
                            @foreach ($estoque_baixo[0] as $eb)
                                <tr>
                                    <td>{{ $eb->nome }}</td>
                                    <td>{{ $eb->quantidade }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Data expiração -->
    <div class="modal fade" id="exampleModalExpirado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Produto com data expirada
                        <a href="{{ route('entradas.create', []) }}" class="btn btn-padrao1">Cadastrar produto
                            estoque</a>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table table-hover" id="table">
                        <thead class="letra" id="thead_colors">
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Data expiração</th>
                        </thead>
                        <tbody>
                            @foreach ($data_expirada[0] as $de)
                                <tr>
                                    <td>{{ $de->nome }}</td>
                                    <td>{{ $de->quantidade }}</td>
                                    <td>{{ Carbon\Carbon::parse($de->validade)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (is_array($balanco_caixa[1]) == true)
        <div class="modal fade" id="exampleModalLucro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Lista das saídas com Lucro
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-hover" id="table">
                            <thead class="letra" id="thead_colors" align="center" style="margin: 0px auto;">
                                <th>Produto</th>
                                <th>Validade</th>
                                <th>Valor Entrada</th>
                                <th>Valor Saída</th>
                                <th>Quantidade</th>
                                <th>Valor do Lucro</th>
                            </thead>
                            <tbody align="center" style="margin: 0px auto;">
                                @foreach ($balanco_caixa[1][1] as $lucro)
                                    <tr>
                                        <td>{{ $lucro->produto_id }}</td>
                                        <td>{{ $lucro->validade_produto }}</td>
                                        <td>R$ {{ number_format($lucro->preco_un, 2, ',', '.') }}</td>
                                        <td>R$ {{ number_format($lucro->preco_saida, 2, ',', '.') }}</td>
                                        <td>{{ $lucro->quantidade }}</td>
                                        <td>R$ {{ number_format($lucro->valor_desconto, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (is_array($balanco_caixa[0]) == true)
        <div class="modal fade" id="exampleModalPrejuizo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Lista das saídas com Prejuízo
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-hover" id="table">
                            <thead class="letra" id="thead_colors" align="center" style="margin: 0px auto;">
                                <th>Produto</th>
                                <th>Validade</th>
                                <th>Valor Entrada</th>
                                <th>Valor Saída</th>
                                <th>Quantidade</th>
                                <th>Valor do Prejuízo</th>
                            </thead>
                            <tbody align="center" style="margin: 0px auto;">
                                @foreach ($balanco_caixa[0][1] as $prejuizo)
                                    <tr>
                                        <td>{{ $prejuizo->produto_id }}</td>
                                        <td>{{ $prejuizo->validade_produto }}</td>
                                        <td>R$ {{ number_format($prejuizo->preco_un, 2, ',', '.') }}</td>
                                        <td>R$ {{ number_format($prejuizo->preco_saida, 2, ',', '.') }}</td>
                                        <td>{{ $prejuizo->quantidade }}</td>
                                        <td>R$ {{ number_format($prejuizo->valor_desconto, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
