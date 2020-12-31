@extends('layouts.default')
    @section('content')
    <h1>Tipos de Clientes</h1>
    <a href="{{ route('tipo_clientes.create', []) }}" class="btn btn-primary">Cadastrar</a><br></br>
    <table class="table table-hover">
        <thead> 
          <th>Nome</th>
          <th>Descrição</th>
          <td></td>     
        </thead>

        <tbody>
          @foreach ($tipo_clientes as $tipo_cliente)
            <tr>
            <td>{{ $tipo_cliente->nome }}</td>
            <td>{{ $tipo_cliente->descricao }}</td>          
            <td>
              <a href="{{ route('tipo_clientes.edit', ['id'=>\Crypt::encrypt($tipo_cliente->id)]) }}" class="btn-sm btn-success">Editar</a>
              <a href="#" onclick="return ConfirmaExclusao({{$tipo_cliente->id}})" class="btn-sm btn-danger">Remover</a>
            </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $tipo_clientes->links() }}
 @stop     
 @section('table-delete')
  "tipo_clientes"
 @endsection
 