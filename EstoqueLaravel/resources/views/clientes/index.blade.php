@extends('adminlte::page')
    @section('content')
    <h1>Clientes</h1>
    
    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar com grupos de botões">
      <div class="btn-group mr-2" role="group" aria-label="Primeiro grupo">
        <div class="btn-group float-sm-left" role="group" aria-label="Exemplo básico">
          <a href="{{ route('clientes.create', []) }}" type="button" class="btn btn-primary">Cadastrar</a>
          <a href="{{ route('tipo_clientes.create', []) }}" type="button" class="btn btn-success">Cadastrar Tipo de Cliente</a>
        </div>
      </div>
      <div class="input-group">
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
      </div>
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
              <a href="{{ route('clientes.edit', ['id'=>\Crypt::encrypt($cliente->id)]) }}" class="btn-sm btn-success">Editar</a>
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
 