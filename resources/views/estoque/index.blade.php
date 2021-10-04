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
                            <h1 class="text-primary">Estoque<i class="fas fa-dolly"></i></h1>
                            <p class="text-gray-700 mb-0">
                                {{-- Lista de todos as entradas de produto do estoque! --}}
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
                            <table class="table table-hover tabela_id" id="table">
                                {{-- @if($estoque->count() != 0) --}}
                                    <thead class="letra" id="thead_colors" align="center" style="margin: 0px auto;">
                                        <th></th>
                                        <th>Código</th>
                                        <th>Produto</th>
                                        <th>Quantidade em Estoque</th>
                                    </thead>

                                    <tbody align="center" style="margin: 0px auto;">
                                        @foreach ($estoque as $e)
                                            <tr>
                                                <td></td>
                                                <td>{{ $e->id }}</td>
                                                <td>{{ $e->nome }}</td>
                                                @if ($e->quantidade > 0)
                                                    <td><span class='badge badge-pill badge-success w-25 p-3' style="font-size: 15px;">{{ $e->quantidade }}</span></td>
                                                @else
                                                    <td ><span class='badge badge-pill badge-danger w-25 p-3' >{{ 'SEM ESTOQUE' }}</span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                {{-- @else
                                    <center><img src="{{ url('/img/stock.png') }}" style="width:100%;height:100%;"></center>
                                @endif --}}
                            </table>
                            {{ $estoque->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('table-delete')
    "estoques"
@endsection
