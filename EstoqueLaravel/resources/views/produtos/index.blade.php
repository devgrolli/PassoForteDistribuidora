@extends('adminlte::page')
    @section('content')
    <h1>Produtos</h1>
    <table class="table table-stripe table-bordered table-hover">
        <thead> 
          <th>Nome</th>
          <th>Preço Unitário</th>
          <th>Quantidade</th>
          <th>Marca</th>
        </thead>

        <tbody>
          @foreach ($produtos as $produto)
            <tr>
            <td>{{ $produto->nome }}</td>
            <td>{{ $produto->preco_un }}</td>
            <td>{{ $produto->quantidade }}</td>
            <td>{{ $produto->marca }}</td>
            <td>
              <a href="{{ route('produtos.edit', ['id'=>$produto->id]) }}" class="btn-sm btn-success">Editar</a>
              <a href="{{ route('produtos.destroy', ['id'=>$produto->id]) }}" class="btn-sm btn-danger">Remover</a>
            </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $produtos->links() }}
    <a href="{{ route('produtos.create', []) }}" class="btn btn-primary">Cadastrar</a>
 @stop     
 @section('table-delete')
  "produtos"
 @endsection
 