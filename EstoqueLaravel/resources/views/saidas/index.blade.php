<!-- blade: sistema de template simples -->
@extends('layouts.default')
    @section('content')
    <h1>Saídas de Produtos</h1>

    <div class="float-sm-left">
      {!! Form::open(['name'=>'form_name', 'route'=>'saidas']) !!}
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
      <a href="{{ route('saidas.create', []) }}" class="btn btn-primary">Cadastrar</a><br></br>
    </div>  

    <div class="float-sm-left">
      <a href="{{ route('tipo_saidas.create', []) }}" class="btn btn-success">Cadastrar Tipo de Saídas</a><br></br>
    </div>

    <table class="table table-stripe table-bordered table-hover">
        <thead> 
          <th>Produto</th>
          <th>Tipo de Saída</th>
          <th>Valor</th>
          <th>Data da saída</th>
        </thead>

        <tbody>
          @foreach ($saidas as $saida)
            <tr>
            <td>{{ $saida->nome}}</td>
            <td>{{ $saida->preco_un}}</td>
            <td>{{ $saida->tipo_saidas->nome}}</td>
            <td>{{ Carbon\Carbon::parse($saida->data_saida)->format('d/m/Y') }}</td>
              <td>
                <a href="{{ route('saidas.edit', ['id'=>$saida->id]) }}" class="btn-sm btn-success">Editar</a>
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
 