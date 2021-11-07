<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/relatorio.css">
        <title>Relatório de Produtos</title>
    </head>
    <h1>Relatório de Produtos</h1>
    <body>
        <div class="container-fluid">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>UN</th>
                        <th>Marca</th>
                        <th>Categoria</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($return_query as $produto)
                        <tr border="1">
                            <td>{{ $produto->id }}</td>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->unidade }}</td>
                            <td>{{ $produto->marca }}</td>
                            <td>{{ $produto->categoria }}</td>
                            <td>{{ $produto->categoria }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>