<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/relatorio.css">
        <title>Relatório de Entrada</title>
    </head>
    <h1>Relatório de Entradas no estoque</h1>
    <body>
        <div class="container-fluid">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cód. Prod</th>
                        <th>Produto</th>
                        <th>Qtd</th>
                        <th>Preço Venda</th>
                        <th>Validade</th>
                        <th>Fornecedor</th>
                        <th>Tipo de Entrada</th>
                        <th>Data Entrada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($return_query as $entrada)
                        <tr border="1">
                            <td>{{ $entrada->cod_prod }}</td>
                            <td>{{ $entrada->produto }}</td>
                            <td>{{ $entrada->quantidade }}</td>
                            <td>R$ {{ $entrada->preco_un }}</td>
                            <td>{{ $entrada->validade }}</td>
                            <td>{{ $entrada->fornecedor }}</td>
                            <td>{{ $entrada->tipo_entrada }}</td>
                            <td>{{ $entrada->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>