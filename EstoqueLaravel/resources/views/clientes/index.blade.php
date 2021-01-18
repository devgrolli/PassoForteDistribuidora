@extends('layouts.default')
@section('content')
    <h1>Clientes</h1>

    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar com grupos de botões">
        <div class="btn-group mr-2" role="group" aria-label="Primeiro grupo">
            <div class="btn-group float-sm-left" role="group" aria-label="Exemplo básico">
                <a href="{{ route('clientes.create', []) }}" type="button" class="btn btn-padrao1">Cadastrar</a>
                <a href="{{ route('tipo_clientes.create', []) }}" type="button" class="btn btn-padrao2">Cadastrar Tipo de
                    Cliente</a>
            </div>
        </div>

        {!! Form::open(['name' => 'form_name', 'route' => 'clientes']) !!}
          <div class="input-group mb-3">
              <input type="text" class="form-control-padrao1" name="desc_filtro" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-padrao1" type="submit" name="search" type="button" id="search-btn" ><i
                  class="fa fa-search"></i></button>
              </div>
      
          </div>
        {!! Form::close() !!}

        {{-- <div class="input-group">
            {!! Form::open(['name' => 'form_name', 'route' => 'clientes']) !!}
            <div calss="sidebar-form">
                <div class="input-group">
                    <input type="text" name="desc_filtro" class="form-control-padrao1" style="width:80% !important;"
                        placeholder="Pesquisa...">
                    <div class="input-group-append">
                        <button type="submit" name="search" id="search-btn" class="btn btn-padrao1"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div> --}}
    </div>




    @include('layouts.alerts')

    <table class="table table-hover" id="table">
        <thead>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Endereço</th>
            <th>Tipo de Cliente</th>
            <th>Descrição</th>
            <td></td>
        </thead>

        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->endereco }}</td>
                    <td>{{ $cliente->tipo_cliente->nome }}</td>
                    <td>{{ $cliente->descricao }}</td> 
                    <td>
                        <a href="{{ route('clientes.edit', ['id' => \Crypt::encrypt($cliente->id)]) }}"class="btn btn-padrao1-icons">
                            <i class="bi bi-pencil-square"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>

                        </a>
                        <a href="#" onclick="return ConfirmaExclusao({{ $cliente->id }})" class="btn btn-padrao2-icons">
                            <i class="bi bi-archive">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-archive" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </i>
                        </a>
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
