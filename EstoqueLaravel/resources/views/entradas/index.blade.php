@extends('layouts.default')
    @section('content')
    <h1>Entradas</h1>

    <div class="float-sm-left">
      {!! Form::open(['name'=>'form_name', 'route'=>'entradas']) !!}
        <div calss="sidebar-form">
          <div class="input-group">
            <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Pesquisa...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </div>
      {!! Form::close() !!}
    </div>

    <div class="float-sm-left">
      <a href="{{ route('entradas.create', []) }}" class="btn btn-primary">Cadastrar</a><br></br>
    </div>  

    <div class="float-sm-left">
      <a href="{{ route('tipo_entradas.create', []) }}" class="btn btn-success">Cadastrar Tipo de Entrada</a><br></br>
    </div>

    <table class="table table-stripe table-bordered table-hover">
        <thead> 
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Preço UN</th>
          <th>Fornecedor</th>
          <th>Data Entrada</th>
          <th>Tipo de Entrada</th>
        </thead>

        <tbody>
          @foreach ($entradas as $entrada)
            <tr>
            <td>{{ $entrada->produto->nome}}</td>
            <td>{{ $entrada->quantidade }}</td>
            <td>{{ $entrada->preco_un}}</td>
            <td>{{ $entrada->fornecedor->razao_social}}</td>
            <td>{{ Carbon\Carbon::parse($entrada->data_entrada)->format('d/m/Y') }}</td>
            <td>{{ $entrada->tipo_entrada->nome }}</td>
              <td>
                <a href="{{ route('entradas.edit', ['id'=>$entrada->id]) }}" class="btn-sm btn-success">Editar</a>
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
 