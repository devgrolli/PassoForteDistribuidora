@include('layouts.popover')
@inject('dashboard', App\Http\Controllers\DashboardController)
@php($estoque_baixo = $dashboard->produtosEstoqueBaixo())
<script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header color-header-modal">
                <h5 class="modal-title" id="exampleModalLabel">Estoque baixo <i class="fas fa-exclamation-triangle"></i></h5>

                <i class="far fa-question-circle" data-toggle="popover" title="Produtos com estoque baixo" 
                    data-placement="right" data-content="Produtos listados em que possuem o estoque inferior a 2 quantidades. Para visualizar mais, clique em 'Ver estoque'">
                </i>

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
                        @foreach ($estoque_baixo[0] as $i => $eb)
                            @if($i >= 5)
                                @break
                            @else
                                <tr>
                                    <td>{{ $eb->nome }}</td>
                                    <td>{{ $eb->unidade }}</td>
                                    <td>{{ $eb->marca }}</td>
                                    <td>{{ $eb->quantidade }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <a href="{{ route('estoque', []) }}" class="btn btn-padrao1">Ver estoque
                    @if($estoque_baixo[0]->count() >= 100)
                        <span style="font-size: 14px" class="badge badge-pill badge-danger">+99</span>
                    @else
                        <span style="font-size: 14px" class="badge badge-pill badge-danger">{{ $estoque_baixo[0]->count() }} </span>
                    @endif
                </a>

                <a href="{{ route('entradas.create', []) }}" class="btn btn-padrao2">
                    Cadastrar <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="loop" colors="primary:#ffffff,secondary:#ffffff" stroke="100" style="width:26px;height:26px;padding-top:0px"></lord-icon>
                </a>
                <button type="button" class="btn btn-padrao3" data-dismiss="modal">Fechar <i class="far fa-window-close"></i></button>
            </div>
        </div>
    </div>
</div>