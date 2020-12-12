<!-- blade: sistema de template simples -->
@extends('layouts.default')
    @section('content')
    <h1>Fornecedores</h1>

    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar com grupos de botões">
      <div class="btn-group mr-2" role="group" aria-label="Primeiro grupo">
        <div class="float-sm-left">
          <a href="{{ route('fornecedores.create', []) }}" class="btn btn-primary">Cadastrar</a>
        </div>
      </div>
      <div class="input-group float-sm-left">
        {!! Form::open(['name'=>'form_name', 'route'=>'fornecedores']) !!}
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
          <th>E-mail</th>
          <th>Endereço</th>
          <th>Bairro</th>
          <th>Telefone</th>
        </thead>

        <tbody>
          @foreach ($fornecedores as $fornecedor)
            <tr>
            <td>{{ $fornecedor->razao_social }}</td>
            <td>{{ $fornecedor->email}}</td>
            <td>{{ $fornecedor->endereco}}</td>
            <td>{{ $fornecedor->bairro}}</td>
            <td>{{ $fornecedor->telefone}}</td>
              <td>
                <a href="{{ route('fornecedores.edit', ['id'=>\Crypt::encrypt($fornecedor->id)]) }}" class="btn-sm btn-success">Editar</a>
                <a href="#" onclick="return ConfirmaExclusao({{$fornecedor->id}})" class="btn-sm btn-danger">Remover</a>
              </td>
            </tr>
          @endforeach    
        </tbody>
    </table>
    {{ $fornecedores->links() }}

 @stop     
 @section('table-delete')
  "fornecedores"
 @endsection
 