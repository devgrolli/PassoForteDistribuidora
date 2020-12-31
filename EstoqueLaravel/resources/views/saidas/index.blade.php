<!-- blade: sistema de template simples -->
@extends('layouts.default')
    @section('content')
    <h1>Saídas de Produtos</h1>

    <div class="btn-group" role="group" aria-label="Exemplo básico">
      <a href="{{ route('saidas.create', []) }}" type="button" class="btn btn-primary">Cadastrar</a>
      <a href="{{ route('tipo_saidas.create', []) }}" type="button" class="btn btn-success">Cadastrar Tipo de Saídas</a>
    </div><br><br>  

    @include('layouts.alerts')

    <table class="table table-hover">
        <thead> 
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Valor</th>
          <th>Data da saída</th>
          <th></th>
        </thead>

        <tbody>
          @foreach ($saidas as $saida)
            <tr>
            <td>{{ $saida->produto->nome}}</td>
              @if ($saida->quantidade < 5)
                <td><span class='badge badge-warning'>{{ $saida->quantidade }} </span></td>
              @elseif($saida->quantidade == 0)
                <td><span class='badge badge-danger'>{{ "ZERO" }}</span></td>
              @else
                <td><span class='badge badge-primary'>{{ $saida->quantidade }} </span></td>
              @endif
            <td>{{ $saida->preco_un}}</td>
            <td>{{ Carbon\Carbon::parse($saida->data_saida)->format('d/m/Y') }}</td>
            {{-- <td>{{ $s->tipo_saidas->nome}}</td> --}}
              <td>
                <a href="{{ route('saidas.edit', ['id'=>\Crypt::encrypt($saida->id)]) }}" class="btn-sm btn-success">Editar</a>
                <a href="#" onclick="return ConfirmaExclusao({{$saida->id}})" class="btn-sm btn-danger">Remover</a>
              </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $saidas->links() }}

 @stop     
 @section('table-delete')
  "saidas"
 @endsection
 