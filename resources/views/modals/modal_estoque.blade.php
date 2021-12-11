@inject('prods', App\Http\Controllers\ProdutosController)
@php($products = $prods->get_all_products())

<link rel="stylesheet" type="text/css" href="../css/default-template.css">
<div class="modal fade" id="exampleModalEstoque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header color-header-modal">
                <h5 class="modal-title" id="exampleModalLabel">Estoque</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @if (!$products->isEmpty())
                    <table class="table table-hover" id="table">
                        <thead class="letra" id="thead_colors">
                            <th></th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td></td>
                                    <td>{{ $product->nome }}</td>
                                    <td>{{ $product->quantidade }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <center><img src="{{ url('/img/sem_estoque.png') }}" style="width:80%;height:80%;"></center>
                @endif
            </div>
        </div>
    </div>
</div>
