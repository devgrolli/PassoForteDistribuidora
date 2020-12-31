@extends('layouts.default')
    @section('content')
    <h1>Entradas</h1>
    
    <div class="btn-group" role="group" aria-label="Exemplo básico">
      <a href="{{ route('entradas.create', []) }}" type="button" class="btn btn-primary">Cadastrar</a>
      <a href="{{ route('tipo_entradas.create', []) }}" type="button" class="btn btn-success">Cadastrar Tipo de Entrada</a>
    </div><br><br>  

    <table class="table table-hover">
        <thead> 
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Preço UN</th>
          <th>Fornecedor</th>
          <th>Data Entrada</th>
          <th>Tipo de Entrada</th>
          <th>Total compra</th>
          <td></td>     
        </thead>

        <tbody>
          @foreach ($entradas as $entrada)
            <tr>
            <td>{{ $entrada->produto->nome}}</td>
            <td> {{ $entrada->quantidade }}</td>
            <td>R$ {{ $entrada->preco_un }}</td>
            <td>{{ $entrada->fornecedor->razao_social}}</td>
            <td>{{ Carbon\Carbon::parse($entrada->data_entrada)->format('d/m/Y') }}</td>
            <td>{{ $entrada->tipo_entrada->nome }}</td>
            <td> R$ {{ $entrada->quantidade * $entrada->preco_un}} </td>
              <td>
                <a href="{{ route('entradas.edit', ['id'=>\Crypt::encrypt($entrada->id)]) }}" class="btn-sm btn-success">Editar</a>
                <a href="#" onclick="return ConfirmaExclusao({{$entrada->id}})" class="btn-sm btn-danger">Remover</a>
              </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $entradas->links() }}

 @stop     
 @section('table-delete')
  "entradas"
 @endsection
 