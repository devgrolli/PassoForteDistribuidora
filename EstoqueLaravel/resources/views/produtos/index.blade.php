@extends('adminlte::page')
    @section('content')
    <h1>Produtos</h1>
    
    {{-- <div class="float-sm-left">
      {!! Form::open(['name'=>'form_name', 'route'=>'produtos']) !!}
        <div calss="sidebar-form">
          <div class="input-group">
            <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Pesquisa...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </div>
      {!! Form::close() !!}
    </div> --}}

    <div class="float-sm-left">
      <a href="{{ route('produtos.create', []) }}" class="btn btn-primary">Cadastrar</a><br></br>
    </div>

    <table class="table table-stripe table-bordered table-hover">
        <thead> 
          <th>Nome</th>
          <th>Estoque</th>
          <th>Preço Unitário</th>
          <th>Marca</th>
        </thead>

        <tbody>
          @foreach ($produtos as $produto)
            <tr>
            <td>{{ $produto->nome }}</td>
            @if ($produto->quantidade > 0 )
              <td><span class='badge badge-success'>{{ $produto->quantidade }} </span></td>
            @else
              <td><span class='badge badge-danger'>{{ "SEM ESTOQUE" }}</span></td>
            @endif
            <td>R$ {{$produto->preco_un }}</td>
            <td>{{ $produto->marca }}</td>

            <td>
              <a href="{{ route('produtos.edit', ['id'=>\Crypt::encrypt($produto->id)]) }}" class="btn-sm btn-success">Editar</a>
              <a href="{{ route('produtos.destroy', ['id'=>$produto->id]) }}" class="btn-sm btn-danger">Remover</a>

            </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $produtos->links() }}

 @stop     
 @section('table-delete')
  "produtos"
 @endsection