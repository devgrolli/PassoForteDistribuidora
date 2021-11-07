<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/relatorio.css">
        <title>Relatório de Clientes</title>
    </head>
    <h1>Relatório de Clientes</h1>
    <body>
        <div class="container-fluid">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>Tipo de Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($return_query as $cliente)
                        <tr border="1">
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->endereco }}</td>
                            <td>{{ $cliente->tipo_cliente }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>