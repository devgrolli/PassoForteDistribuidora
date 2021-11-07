@inject('dashboard', App\Http\Controllers\DashboardController)
@php($estoque_baixo = $dashboard->produtosEstoqueBaixo())

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header color-header-modal">
                <h5 class="modal-title" id="exampleModalLabel">Estoque baixo <i class="fas fa-exclamation-triangle"></i></h5>

                <button type="button" class="close modal-close-color" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-hover" id="table-modal">
                    <thead class="letra" id="thead_colors" align="center" style="margin: 0px auto;">
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Marca</th>
                        <th>Quantidade</th>
                    </thead>
                    <tbody align="center" style="margin: 0px auto;">
                        @foreach ($estoque_baixo[0] as $eb)
                            <tr>
                                <td>{{ $eb->nome }}</td>
                                <td>{{ $eb->unidade }}</td>
                                <td>{{ $eb->marca }}</td>
                                <td>{{ $eb->quantidade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <a href="{{ route('estoque', []) }}" class="btn btn-padrao1">Visualizar estoque <i class="fas fa-dolly"></i></a>
                <a href="{{ route('entradas.create', []) }}" class="btn btn-padrao2">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></a>
                <button type="button" class="btn btn-padrao3" data-dismiss="modal">Fechar <i class="far fa-window-close"></i></button>
            </div>
        </div>
    </div>
</div>