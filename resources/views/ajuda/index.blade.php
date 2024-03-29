@extends('layouts.default')
@section('content')
    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <lord-icon src="https://cdn.lordicon.com/zpxybbhl.json" trigger="loop"
                    colors="primary:#006f88,secondary:#4c5253" stroke="70" style="width:150PX;height:150PX">
                </lord-icon>
                <h1 class="display-4">Precisa de uma ajuda?</h1>
                <p class="lead">Siga o passo a passo abaixo para entender sobre o gerencimaneto do estoque. Para continuar
                    acesse os menus a sua esquerda, caso contrário,
                    clique no botão abaixo para saber mais ou visualize o dashbaord</p>
                <hr class="my-4">

                <div id="accordion">
                    <div class="card">
                        <div class="card-header ajuda-div" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed btn-lg btn-ajuda" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Dashboard <i class="fas fa-angle-down"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body card-body-text">
                                No painel de contro (dashboard), podemos visualizar algumas métricas sobre as movimentações do estoque, status de alguns produtos,
                                pontos de atenção, entre outras coisas. Para obter mais informações, clique sobre os ícones animados e então será exibido uma janela na tela.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header ajuda-div" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-lg collapsed btn-ajuda" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Fornecedor <i class="fas fa-angle-down"></i>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body card-body-text">
                                Tudo começa com fornecedor dos produtos não é mesmo? Por primeiro, cadastre o fornecedor dos
                                produtos/marcas que você está trabalhando
                                para então poder prosseguir com o processo do gerencimaneto de estoque. Clique no menu lateral com o nome "Fornecedor" e depois clique em "Listagem" 
                                para poder cadastrar.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header ajuda-div" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed btn-lg btn-ajuda" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Produto <i class="fas fa-angle-down"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body card-body-text">
                                Segundo processo do gerenciamento é o cadastro dos produtos do fornecedor.
                                Acesse a página de produto através do menu lateral
                                e cadastre os produtos. Sempre que um produto é cadastrado seu estoque está zerado. Para
                                conferir o status do estoque, acesse a página "Estoque" no menu lateral e confirma o status do produto no estoque.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header ajuda-div" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-lg collapsed" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Entrada <i class="fas fa-angle-down"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body card-body-text">
                                Inicialize sua movimentação de estoque nas entradas de produtos no estoque, também presente
                                no menu lateral.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header ajuda-div" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link btn-lg collapsed" data-toggle="collapse" data-target="#collapseFive"
                                aria-expanded="false" aria-controls="collapseFive">
                                Saída <i class="fas fa-angle-down"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body card-body-text">
                            Agora para movimentar o estoque, realize as saídas dos produtos de seu estoque acessando a
                            página e realizando
                            as saídas dos produtos pelo cadastro.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.spinner')
@endsection
