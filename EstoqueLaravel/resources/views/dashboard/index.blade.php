@extends('layouts.default')
@section('content')

    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <div class="col main pt-5 mt-3">
        <h5 class="display-4 dashtext d-none d-sm-block">
            Dashboard
        </h5>

        <div class="row mb-3">
            <div class="col-xl-3 col-sm-6 py-2" >
                <div class="card text-white bg_1 h-100">
                    <div class="card-body">
                        <div class="rotate">
                            <a href="{{ route('clientes', []) }}" ><i class="fas fal fa-users fa-4x"></i></a>
                        </div>
                        <h6 class="text-uppercase">Total de Clientes</h6><br>
                        <hr>
                        <h1 class="display-4">{{ $total_clientes}}</h1>    
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg_2 h-100">
                    <div class="card-body">
                        <div class="rotate">
                            <a href="{{ route('produtos', []) }}" ><i class="fas fa-fw fal fa-barcode fa-4x"></i></a>
                        </div>
                        <h6 class="text-uppercase">Produtos Cadastrados</h6><br>
                        <hr>
                        <h1 class="display-4">{{ $total_produtos}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg_3 h-100">
                    <div class="card-body ">
                        <div class="rotate">
                            <a href="{{ route('entradas', []) }}" ><i class="fas fa-fw fal  fa-shopping-cart fa-4x"></i></a>
                        </div>
                        <h6 class="text-uppercase">Total de Entradas</h6>
                        <h6 class="text-uppercase">R$ {{ number_format($saldo_entrada, 2, ',', '.') }}</h6>
                        <hr>
                        <h1 class="display-4">{{ $total_entradas }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg_4 h-100">
                    <div class="card-body">
                        <div class="rotate">
                            <a href="{{ route('saidas', []) }}" ><i class="fa fa-share fa-4x"></i></a>
                        </div>
             
                        <h6 class="text-uppercase">Total de Saídas</h6>
                        <h6 class="text-uppercase">R$ {{ number_format($saldo_saida, 2, ',', '.') }}</h6>
                        <hr>
                        <h1 class="display-4">{{ $total_saidas }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card bg_5 h-100">
                    <div class="card-body">
                        <div class="rotate">
                            <i class="fas fal fa-chart-line fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Total de Caixa</h6><br>
                        <hr>
                        <h1 class="display-4">R$ {{ number_format($caixa, 2, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card bg_6 h-100">
                    <div class="card-body ">
                        <div class="rotate">
                            <a href="{{ route('entradas', []) }}" ><i class="fas fa-fw fal fa-exclamation-triangle fa-4x"></i></a>
                        </div>
                        <h6 class="text-uppercase">Produtos com estoque baixo</h6>
                        <button class="btn btn-padrao2" type="button" data-toggle="modal" data-target="#exampleModal">
                            Visualizar produtos <i class="fa fa-window-restore"></i></button> 
                        <hr>
                        <h1 class="display-4">{{ $qtd_estoque_baixo }}</h1>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Estoque baixo 
                <a href="{{ route('entradas.create', []) }}" class="btn btn-padrao1">Cadastrar entradas</a>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <table class="table table-hover" id="table">
                <thead>
                  <th>Nome</th>
                  <th>Estoque</th>
                </thead>
                <tbody>
                  @foreach ($estoque_baixo as $eb)
                    <tr>
                      <td>{{ $eb->nome }}</td>
                      <td>{{ $eb->quantidade }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>          
            </div>     
          </div>
        </div>
      </div>
        
        <!--/row-->

        <hr>
        <div class="row placeholders mb-3">
            <div class="col-6 col-sm-3 placeholder text-center">
                <img src="//placehold.it/200/dddddd/fff?text=1" class="mx-auto img-fluid rounded-circle"
                    alt="Generic placeholder thumbnail">
                <h4>Responsive</h4>
                <span class="text-muted">Device agnostic</span>
            </div>
            <div class="col-6 col-sm-3 placeholder text-center">
                <img src="//placehold.it/200/e4e4e4/fff?text=2" class="mx-auto img-fluid rounded-circle"
                    alt="Generic placeholder thumbnail">
                <h4>Frontend</h4>
                <span class="text-muted">UI / UX oriented</span>
            </div>
            <div class="col-6 col-sm-3 placeholder text-center">
                <img src="//placehold.it/200/d6d6d6/fff?text=3" class="mx-auto img-fluid rounded-circle"
                    alt="Generic placeholder thumbnail">
                <h4>HTML5</h4>
                <span class="text-muted">Standards-based</span>
            </div>
            <div class="col-6 col-sm-3 placeholder text-center">
                <img src="//placehold.it/200/e0e0e0/fff?text=4" class="center-block img-fluid rounded-circle"
                    alt="Generic placeholder thumbnail">
                <h4>Framework</h4>
                <span class="text-muted">CSS and JavaScript</span>
            </div>
        </div>
    </div>



    {{--
    <!--Section: Block Content-->
    <section>

        <!--Grid row-->
        <div class="row">

            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4">

                <!-- Card -->
                <div class="card">

                    <div class="card-body">

                        <p class="text-uppercase small mb-2"><strong>Total sales</strong></p>
                        <h5 class="font-weight-bold mb-0">
                            $ 4567
                            <small class="text-success ml-2">
                                <i class="fas fa-arrow-up fa-sm pr-1"></i>13,48%</small>
                        </h5>

                        <hr>

                        <p class="text-uppercase text-muted small mb-2"><strong>Previous period</strong></p>
                        <h5 class="font-weight-bold text-muted mb-0">
                            $ 3467
                        </h5>

                    </div>

                </div>
                <!-- Card -->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <!-- Card -->
                <div class="card">

                    <div class="card-body">

                        <p class="text-uppercase small mb-2"><strong>Orders</strong></p>
                        <h5 class="font-weight-bold mb-0">
                            534
                            <small class="text-success ml-2">
                                <i class="fas fa-arrow-up fa-sm pr-1"></i>23,58%</small>
                        </h5>

                        <hr>

                        <p class="text-uppercase text-muted small mb-2"><strong>Previous period</strong></p>
                        <h5 class="font-weight-bold text-muted mb-0">
                            354
                        </h5>

                    </div>

                </div>
                <!-- Card -->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <!-- Card -->
                <div class="card">

                    <div class="card-body">

                        <p class="text-uppercase small mb-2"><strong>Average order value</strong></p>
                        <h5 class="font-weight-bold mb-0">
                            123
                            <small class="text-danger ml-2">
                                <i class="fas fa-arrow-down fa-sm pr-1"></i>23,58%</small>
                        </h5>

                        <hr>

                        <p class="text-uppercase text-muted small mb-2"><strong>Previous period</strong></p>
                        <h5 class="font-weight-bold text-muted mb-0">
                            186
                        </h5>

                    </div>

                </div>
                <!-- Card -->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </section>
    <!--Section: Block Content-->
    <!--Section: Block content--> --}}
@stop
