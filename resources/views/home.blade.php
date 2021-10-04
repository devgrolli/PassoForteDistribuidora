@extends('layouts.default')

@section('content')
<link rel="stylesheet" type="text/css" href="css/default-template.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <h1 class="display-4">Seja Bem-Vindo</h1>
                <p class="lead">Esse programa irá lhe auxiliar a gerenciar e organizar o estoque da sua empresa de forma simples.</p>
                <hr class="my-4">
                <p>Para continuar acesse os menus a sua esquerda, caso contrário, clique no botão abaixo para saber mais ou visualize o dashboard.</p>
                <p class="lead">
                  <a class="btn btn btn-padrao1 btn-lg" href="#" role="button">Saiba mais</a>
                  <a href="{{ route('dashboard', []) }}" class="btn btn btn-padrao2 btn-lg" role="button">Dashboard</a>
                </p>
              </div>
        </div>
    </div>
</div>
@endsection
