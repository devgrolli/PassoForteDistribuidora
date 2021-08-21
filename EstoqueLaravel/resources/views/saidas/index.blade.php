<!-- blade: sistema de template simples -->
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
                            <h1 class="text-primary">Saídas<i class="fas fa-fw fal fa fa-share"> </i></h1>
                            <p class="text-gray-700 mb-0">
                                Lista de todas as saídas de produto do estoque!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @include('layouts.alerts') --}}

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
                                                <div class="btn-group" role="group" aria-label="Exemplo básico">
                                                    <a href="{{ route('saidas.create', []) }}" type="button"
                                                        class="btn btn-padrao1-div_table">Cadastrar
                                                        <i class="bi bi-cart-plus-fill"></i>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                            fill="currentColor" class="bi bi-cart-plus-fill"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('tipo_saidas', []) }}" type="button"
                                                        class="btn btn-padrao2-div_table">Cadastrar Tipo de Saída
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-padrao1-div_table" data-toggle="modal" data-target="#excelModal">
                                                        Exportar Excel <i class="fas fa-file-export"></i>
                                                    </button>
                                                </div><br><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover" id="table">
                            <thead class="letra" id="thead_colors" align="center" style="margin: 0px auto;">
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor de saída</th>
                                <th>Tipo da Saída</th>
                                <th>Data da saída</th>
                                <th></th>
                            </thead>

                            <tbody align="center" style="margin: 0px auto;">
                                @foreach ($saidas as $saida)
                                    <tr>
                                        <td>{{ $saida->produto->nome }}</td>
                                        <td>{{ $saida->quantidade }} </td>
                                        <td>R$ {{ number_format($saida->preco_saida, 2, ',', '.') }}</td>
                                        <td>{{ $saida->tipo_saidas_id }}</td>
                                        <td>{{ Carbon\Carbon::parse($saida->created_at)->format('d/m/Y - H:i:s') }}</td>
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
                                                {{-- <a href="{{ route('saidas.destroy', ['id' => $saida->id]) }}"> --}}
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
                {!! Form::open(['route' => ['export', 'type'=> 'saidas']]) !!}
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
    @include('sweetalert::alert')
@stop
@section('table-delete')
    "saidas"
@endsection
