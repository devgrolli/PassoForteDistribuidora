@extends('layouts.default')
    @section('content')
    <h1>Tipo de Entradas</h1>
    <a href="{{ route('tipo_entradas.create', []) }}" class="btn btn-primary">Cadastrar</a><br></br>
    <table class="table table-hover">
        <thead> 
          <th>Nome</th>
          <th>Descrição</th>
          <td></td>     
        </thead>

        <tbody>
          @foreach ($tipo_entradas as $tipo_entrada)
            <tr>
            <td>{{ $tipo_entrada->nome }}</td>
            <td>{{ $tipo_entrada->descricao }}</td>          
            <td>
              <a href="{{ route('tipo_entradas.edit', ['id'=>\Crypt::encrypt($tipo_entrada->id)]) }}" class="btn-sm btn-success">Editar</a>
              <a href="#" onclick="return ConfirmaExclusao({{$tipo_entrada->id}})" class="btn-sm btn-danger">Remover</a>
            </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $tipo_entradas->links() }}

 @stop     
 @section('table-delete')
  "tipo_entradas"
 @endsection
 