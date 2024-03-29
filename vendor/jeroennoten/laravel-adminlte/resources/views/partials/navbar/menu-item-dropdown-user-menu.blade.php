@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@inject('dashboard', App\Http\Controllers\DashboardController)

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

@php($estoque = $dashboard->produtosEstoqueBaixo()[1])
@php($validade = $dashboard->validadeExpirada()[1])
@php($soma = $estoque + $validade)


<script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
<div class="dropdown">
    <a class="btn position-relative novo" href="{{ route('ajuda', []) }}"><i class="far fa-handshake" data-toggle="tooltip" data-placement="top" title="Ajuda"></i></a>
    <button class="btn position-relative novo" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if($soma != 0)
            <i class="far fa-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $soma }}</span>
        @else
            <i class="far fa-bell-slash"></i>
        @endif
    </button>
    <div class="dropdown-menu">
        @if($soma == 0)
            <a class="dropdown-item" href="#"> Você não possui notificações. </a>
        @else
            <a class="dropdown-item" href="#"> Você possui novas notificações </a>
            <div class="dropdown-divider"></div>
        @endif

        @if($estoque > 0)
            @if(Route::getCurrentRoute()->getName() == 'estoque')
                <a class="dropdown-item" ><i class="fas fa-dolly p-2"></i> 
                    Produtos abaixo do Estoque <span class="badge badge-danger w-10 p-2" style="background-color: #8400ff "> {{$estoque}} </span>
                </a>
            @else
                <button class="btn" type="button" data-toggle="modal" data-target="#exampleModal" style="display: flex;">
                    <i class="fas fa-dolly p-2"></i> Produtos abaixo do Estoque <span class="badge badge-danger w-10 p-2" style="background-color: #8400ff "> {{$estoque}} </span>
                </button>
            @endif
        @endif

        @if($validade > 0)
            <button class="btn " type="button" data-toggle="modal" data-target="#exampleModalExpirado" style="display: flex;"> 
                <i class="far fa-calendar-times p-2"></i>Produtos com validade expirada <span class="badge badge-danger w-10 p-2"> {{$validade}} </span>
            </button>
            {{-- <a class="dropdown-item" href="{{ route('dashboard', []) }}"> 
                Produtos com validade expirada  <span class="badge badge-danger w-10 p-2"> {{$validade}} </span>
            </a> --}}
        @endif
    </div>
</div>

<li class="nav-item dropdown">
    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if(config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}"
                 class="user-image img-circle elevation-2"
                 alt="{{ Auth::user()->name }}">
        @endif
        <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
            {{ Auth::user()->name }}
        </span>
    </a>

    {{-- User menu dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        
        {{-- User menu header --}}
        @if(!View::hasSection('usermenu_header') && config('adminlte.usermenu_header'))
            <li class="user-header {{ config('adminlte.usermenu_header_class', 'bg-primary') }}
                @if(!config('adminlte.usermenu_image')) h-auto @endif">
                @if(config('adminlte.usermenu_image'))
                    <img src="{{ Auth::user()->adminlte_image() }}"
                         class="img-circle elevation-2"
                         alt="{{ Auth::user()->name }}">
                @endif
                <p class="@if(!config('adminlte.usermenu_image')) mt-0 @endif">
                    {{ Auth::user()->name }}
                    @if(config('adminlte.usermenu_desc'))
                        <small>{{ Auth::user()->adminlte_desc() }}</small>
                    @endif
                </p>
            </li>
            
        @else
            @yield('usermenu_header')
        @endif

        {{-- Configured user menu links --}}
        @each('adminlte::partials.navbar.dropdown-item', $adminlte->menu("navbar-user"), 'item')

        {{-- User menu body --}}
        @hasSection('usermenu_body')
            <li class="user-body">
                @yield('usermenu_body')
            </li>
        @endif

        {{-- User menu footer --}}
        <li class="user-footer">
            @if($profile_url)
                <a href="{{ $profile_url }}" class="btn btn-default btn-flat">
                    <i class="fa fa-fw fa-user"></i>
                    {{ __('adminlte::menu.profile') }}
                </a>
            @endif
            <a class="dropdown-item" href="{{ route('usuarios', []) }}">
                <lord-icon src="https://cdn.lordicon.com/sbiheqdr.json" trigger="loop" colors="primary:#000000,secondary:#000000" stroke="80" style="width:30px;height:30px"></lord-icon>
            {{-- <i class="fas fa-cog"></i> --}} Configurações de Usuário</a>
             
            <div class="dropdown-divider"></div>
            <a class="dropdown-item 
                @if(!$profile_url) btn-block @endif" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <lord-icon src="https://cdn.lordicon.com/lywgqtim.json" trigger="loop" colors="primary:#121331,secondary:#000000" stroke="80" style="width:30px;height:30px"></lord-icon>
                {{-- <i class="fas fa-sign-out-alt"></i> --}}
                {{ __('adminlte::adminlte.log_out') }}
            </a>

            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
        </li>

    </ul>

</li>
