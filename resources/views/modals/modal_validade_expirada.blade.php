@inject('dashboard', App\Http\Controllers\DashboardController)

@php($validade = $dashboard->validadeExpirada())

<div class="modal fade" id="exampleModalExpirado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header color-header-modal">
                <h5 class="modal-title" id="exampleModalLabel">Produto com data expirada <i class="far fa-calendar-times"></i></h5>
                <button type="button" class="close modal-close-color" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-hover" id="table-modal">
                    <thead class="letra" id="thead_colors" align="center" style="margin: 0px auto;">
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Data expiração</th>
                    </thead>
                    <tbody align="center" style="margin: 0px auto;">
                        @foreach ($validade[0] as $de)
                            <tr>
                                <td>{{ $de->nome }}</td>
                                <td>{{ $de->quantidade }}</td>
                                <td style="color: #d82828; font-weight: bold;">{{ Carbon\Carbon::parse($de->validade)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <a href="{{ route('entradas.create', []) }}" class="btn btn-padrao1">Cadastrar produto estoque <i class="fa fa-plus" aria-hidden="true"></i></a>
                <button type="button" class="btn btn-padrao3" data-dismiss="modal">Fechar <i class="far fa-window-close"></i></button>
            </div>
        </div>
    </div>
</div>
