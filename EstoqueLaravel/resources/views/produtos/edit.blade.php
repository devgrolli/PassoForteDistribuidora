@extends('adminlte::page')
@section('content')
@include('layouts.spinner')
    <link rel="stylesheet" type="text/css" href="../css/default-template.css">
    <div id="div_create">
      <div class="card">
       <div class="card-header">
         <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
           <h1 class="text-create"><strong>Cadastro Produtos</strong></h1> 
         </div>
       </div>
   
       <div class="card-body" id="card_crud">
        {!! Form::open(['route'=> ["produtos.update", 'id'=>$produto->id], 'method'=>'put']) !!}

        <div class="form-row">
          <div class="col">
            {!! Form::label('id', 'Código') !!}
            {!! Form::text('id', $produto->id, ['class'=>'form-control', 'disabled']) !!}
          </div>
          <div class="col">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', $produto->nome, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
            {!! Form::label('unidade', 'Unidade') !!}
            {!! Form::text('unidade', $produto->unidade, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="col">
              {!! Form::label('marca', 'Marca') !!}
              {!! Form::text('marca', $produto->marca, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            {!! Form::label('categorias_id', 'Categorias') !!}
            {!! Form::select('categorias_id', \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), 
                                                  $produto->categorias_id, ['class'=>'form-control', 'required']) !!}
          </div>
        </div>
        <br>
          <div class="form-group">
            {!! Form::button('Salvar <i class="far fa-save"></i>',['class'=>'btn btn-padrao1', 'type'=>'submit']) !!}
            <a href="{{ route('produtos', []) }}" class="btn btn-padrao2">Cancelar <i class="fas fa-ban"></i></a>
          </div>
        {!! Form::close() !!} <!-- id do campo de entrada deve ter o mesmo nome no banco de dados ex: 'nome' --> 
      </div>
    </div>
  </div>
    @include('sweetalert::alert')
@stop