@extends('layouts.default')
@section('content')
    <h1>Estoque</h1>

    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar com grupos de botões">
        
        {!! Form::open(['name' => 'form_name', 'route' => 'estoque']) !!}
          <div class="input-group mb-3">
              <input type="text" class="form-control-padrao1" name="desc_filtro" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-padrao1" type="submit" name="search" type="button" id="search-btn" ><i
                  class="fa fa-search"></i></button>
              </div>
      
          </div>
        {!! Form::close() !!}
    </div>

    @include('layouts.alerts')

    <table class="table table-hover" id="table">
        <thead>
            <th>Código</th>
            <th>Produto</th>
            <th>Quantidade</th>
        </thead>

        <tbody>
            @foreach ($estoque as $e)
                <tr>
                    <td>{{ $e->id }}</td>
                    <td>{{ $e->nome }}</td>
                    @if ($e->quantidade > 0)
                        <td><span class='badge badge-pill badge-success w-25 p-3'>{{ $e->quantidade }} </span></td>
                    @else
                        <td><span class='badge badge-pill badge-danger w-25 p-3'>{{ 'SEM ESTOQUE' }}</span></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $estoque->links() }}

@stop
@section('table-delete')
    "estoques"
@endsection
