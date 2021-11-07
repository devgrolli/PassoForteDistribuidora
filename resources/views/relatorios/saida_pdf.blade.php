<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/relatorio.css">
        <title>Relatório de Saída</title>
    </head>
    <h1>Relatório de Saída no estoque</h1>
    <body>
        <div class="container-fluid">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cód. Prod</th>
                        <th>Produto</th>
                        <th>Validade</th>
                        <th>Qtd</th>
                        <th>Preço Venda</th>
                        <th>Tipo de Saída</th>
                        <th>Data Saída</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($return_query as $entrada)
                        <tr border="1">
                            <td>{{ $entrada->cod_prod }}</td>
                            <td>{{ $entrada->produto }}</td>
                            <td>{{ $entrada->validade_produto }}</td>
                            <td>{{ $entrada->quantidade }}</td>
                            <td>R$ {{ $entrada->preco_saida }}</td>
                            <td>{{ $entrada->tipo_saida }}</td>
                            <td>{{ $entrada->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>