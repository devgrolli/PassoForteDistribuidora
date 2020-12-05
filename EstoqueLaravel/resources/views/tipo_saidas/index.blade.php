@extends('adminlte::page')
    @section('content')
    <h1>Tipo de Saídas</h1>
    <a href="{{ route('tipo_saidas.create', []) }}" class="btn btn-primary">Cadastrar</a><br></br>
    <table class="table table-stripe table-bordered table-hover">
        <thead> 
          <th>Nome</th>
          <th>Descrição</th>
        </thead>

        <tbody>
          @foreach ($tipo_saidas as $tipo_saida)
            <tr>
            <td>{{ $tipo_saida->nome }}</td>
            <td>{{ $tipo_saida->descricao }}</td>          
            <td>
              <a href="{{ route('tipo_saidas.edit', ['id'=>$tipo_saida->id]) }}" class="btn-sm btn-success">Editar</a>
              <a href="{{ route('tipo_saidas.destroy', ['id'=>$tipo_saida->id]) }}" class="btn-sm btn-danger">Remover</a>
            </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $tipo_saidas->links() }}

 @stop     
 @section('table-delete')
  "tipo_saidas"
 @endsection
 