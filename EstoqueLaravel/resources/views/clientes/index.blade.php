@extends('adminlte::page')
    @section('content')
    <h1>Clientes</h1>
    
    <div class="float-sm-left">
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
      <br>
    </div>

    <div class="float-sm-left">
      <a href="{{ route('clientes.create', []) }}" class="btn btn-primary">Cadastrar</a><br></br>
    </div>

    <div class="float-sm-left">
      <a href="{{ route('tipo_clientes.create', []) }}" class="btn btn-success float-sm-left">Cadastrar Tipo de Cliente</a><br></br>
    </div>
  
    <table class="table table-stripe table-bordered table-hover">
        <thead> 
          <th>Nome</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th>Descrição</th>
          <th>Tipo de Cliente</th>
        </thead>

        <tbody>
          @foreach ($clientes as $cliente)
            <tr>
            <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->telefone }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->descricao }}</td>
            <td>{{ $cliente->tipo_cliente->nome }}</td>            
            <td>
              <a href="{{ route('clientes.edit', ['id'=>$cliente->id]) }}" class="btn-sm btn-success">Editar</a>
              <a href="{{ route('clientes.destroy', ['id'=>$cliente->id]) }}" class="btn-sm btn-danger">Remover</a>
            </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $clientes->links() }}

 @stop     
 @section('table-delete')
  "clientes"
 @endsection
 