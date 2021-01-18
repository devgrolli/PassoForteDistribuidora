@extends('csv_file')

@section('csv_data')
<table class="table table-hover" id="table">
    <thead>
        <th>Nome</th>
        <th>Estoque</th>
        <th>Preço Unitário</th>
        <th>Marca</th>
        <td></td>
    </thead>

    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->nome }}</td>
                <td> {{ $row->quantidade }}</td>
                <td>R$ {{ number_format($row->preco_un, 2, ',', '.') }}</td>
                <td>{{ $row->marca }}</td>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ !! $data->links() !! }}

@endsection