@extends('adminlte::page')
    @section('content')
    <h1>Clientes</h1>
    <table class="table table-stripe table-bordered table-hover">
        <thead> 
          <th>Nome</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th>Descrição</th>
        </thead>

        <tbody>
          @foreach ($clientes as $cliente)
            <tr>
            <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->telefone }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->descricao }}</td>
            <td>
              <a href="{{ route('clientes.edit', ['id'=>$cliente->id]) }}" class="btn-sm btn-success">Editar</a>
              <a href="{{ route('clientes.destroy', ['id'=>$cliente->id]) }}" class="btn-sm btn-danger">Remover</a>
            </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $clientes->links() }}
    <a href="{{ route('clientes.create', []) }}" class="btn btn-primary">Cadastrar</a>
 @stop     
 @section('table-delete')
  "clientes"
 @endsection
 