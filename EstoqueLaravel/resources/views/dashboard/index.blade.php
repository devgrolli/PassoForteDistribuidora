@extends('layouts.default')
@section('content')

    <link rel="stylesheet" type="text/css" href="css/default-template.css">
    <h7 class="display-4 dashtext d-none d-sm-block ">
        Dashboard
    </h7>
      <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-entrada shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h6>
                                Total de Entradas</h6></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ number_format($saldo_entrada, 2, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('entradas', []) }}" >
                                <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com//uetqnvvg.json"
                                    trigger="loop"
                                    colors="primary:#173820,secondary:#173820"
                                    stroke="71"
                                    style="width:70PX;height:70PX">
                                </lord-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-saida shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h6>Total de Saídas</h6></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ number_format($saldo_saida, 2, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                            <a href="{{ route('saidas', []) }}" >
                                <lord-icon
                                    src="https://cdn.lordicon.com//krmfspeu.json"
                                    trigger="loop"
                                    colors="primary:#4c5253,secondary:#4c5253"
                                    stroke="80"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-estoque shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h6>Produtos com estoque baixo</h6></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $estoque_baixo[1] }}</div>
                        </div>
                        <div class="col-auto">
                            <button class="btn " type="button" data-toggle="modal" data-target="#exampleModal"> 
                            <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                            <lord-icon
                                src="https://cdn.lordicon.com//tdrtiskw.json"
                                trigger="loop"
                                colors="primary:#0a4e5c,secondary:#0a4e5c"
                                stroke="80"
                                style="width:70px;height:70px">
                            </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-cliente shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h6>Total de Clientes</h6></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_clientes}}</div>
                        </div>
                        
                        <div class="col-auto">
                            <a href="{{ route('clientes', []) }}">
                                <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com//uukerzzv.json"
                                    trigger="loop"
                                    colors="primary:#ff5e32,secondary:#000000"
                                    stroke="80"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </a>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-caixa shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            @if(is_array($caixa) == true)
                                <h6 style="color: #FF0000" >Total de Caixa - Prejuízo 
                                    <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com//tdrtiskw.json"
                                        trigger="loop"
                                        colors="primary:#FF0000,secondary:#FF0000"
                                        stroke="90"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </h6></div>
                                <div class="h5 mb-0 font-weight-bold text-red-800" style="color: #FF0000">
                                    R$ {{ number_format($caixa[0], 2, ',', '.') }} 
                                </div>
                            @else
                                <h6>Total de Caixa</h6></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ number_format($caixa, 2, ',', '.') }}</div>
                            @endif
                        </div>

                        <div class="col-auto">
                            @if(is_array($caixa) == true)
                                <svg  viewBox="0 0 24 24"  width="70" height="70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <style>
                                    @keyframes downit{0%{opacity:0;transform:translate(0,-4px) scaleX(.9) scaleY(.9)}25%{opacity:1;transform:translate(0,2px) 
                                        scaleX(.7) scaleY(.7)}to{opacity:0;transform:translate(0,2px) scaleX(1) scaleY(1)}}
                                </style>
                                    <circle cx="12" cy="12" r="8.5" stroke="#242424"/>
                                    <path d="M12.5 8a.5.5 0 00-1 0h1zm-1 7.2a.5.5 0 001 0h-1zm-2.146-2.754a.5.5 0 00-.708.708l.708-.708zM12 15.8l-.354.354a.5.5 0 00.708 0L12 15.8zm3.354-2.646a.5.5 0 00-.708-.708l.708.708zM11.5 8v7.2h1V8h-1zm-2.854 5.154l3 3 .708-.708-3-3-.708.708zm3.708 3l3-3-.708-.708-3 3 .708.708z" 
                                    fill="#242424" style="animation:downit cubic-bezier(.9,-.32,0,1.56) 1.5s infinite;transform-origin:50% 50%"/>
                                </svg>
                            @else
                                <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com//gqdnbnwt.json"
                                    trigger="loop"
                                    colors="primary:#eeca66,secondary:#eeca66"
                                    stroke="80"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-dash border-left-produtos shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h6>Produtos cadastrados</h6></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_produtos}}</div>
                        </div>
                        <div class="col-auto">
                            <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com//slkvcfos.json"
                                    trigger="loop"
                                    colors="primary:#f8efbe,secondary:#f8efbe"
                                    stroke="80"
                                    style="width:70PX;height:70PX">
                                </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($data_expirada[1] > 0)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-dash border-left-vencimento shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h6>Produtos com Validade expirada</h6></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_expirada[1] }}</div>
                            </div>
                            <div class="col-auto">
                                <button class="btn " type="button" data-toggle="modal" data-target="#exampleModalExpirado"> 
                                <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com//tvyxmjyo.json"
                                    trigger="loop"
                                    colors="primary:#0cf29d,secondary:#000000"
                                    stroke="80"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Estoque baixo-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Estoque baixo 
                <a href="{{ route('entradas.create', []) }}" class="btn btn-padrao1" >Cadastrar entradas</a>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                <table class="table table-hover" id="table">
                    <thead class="letra" id="thead_colors"  >
                        <th>Nome</th>
                        <th>Estoque</th>
                    </thead>
                <tbody>
                  @foreach ($estoque_baixo[0] as $eb)
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
        
         <!-- Modal Data expiração -->
      <div class="modal fade" id="exampleModalExpirado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Produto com data expirada 
                <a href="{{ route('entradas.create', []) }}" class="btn btn-padrao1" >Cadastrar produto estoque</a>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                <table class="table table-hover" id="table">
                    <thead class="letra" id="thead_colors">
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Data expiração</th>
                    </thead>
                <tbody>
                  @foreach ($data_expirada[0] as $de)
                    <tr>
                      <td>{{ $de->nome }}</td>
                      <td>{{ $de->quantidade }}</td>
                      <td>{{ Carbon\Carbon::parse($de->validade)->format('d/m/Y') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>     
          </div>
        </div>
      </div>

          {{-- <div class="col main pt-2  mt-3">
        <div class="row mb-3">
            <div class="col-xl-3 col-sm-1 py-2" >
                <div class="card text-white bg_1">
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
                <div class="card text-white bg_2">
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
                <div class="card text-white bg_3">
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
                <div class="card text-white bg_4 h-60">
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
                <div class="card bg_5 h-60">
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
                <div class="card bg_6 h-60">
                    <div class="card-body ">
                        <div class="rotate">
                            <a href="{{ route('entradas', []) }}" ><i class="fas fa-fw fal fa-exclamation-triangle fa-4x"></i></a>
                        </div>
                        <h6 class="text-uppercase">Produtos com estoque baixo</h6>
                        <button class="btn btn-padrao2" type="button" data-toggle="modal" data-target="#exampleModal">
                            Visualizar <i class="fa fa-window-restore"></i></button> 
                        <hr>
                        <h1 class="display-4">{{ $estoque_baixo[1] }}</h1>
                    </div>
                </div>
            </div>
        </div>
         --}}
        
        <!--/row-->

        {{-- <hr>
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
        </div> --}}
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
