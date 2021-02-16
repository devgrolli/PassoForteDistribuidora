<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Embellished 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140207

-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="http://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="css/page-welcome.css" rel="stylesheet" type="text/css" media="all" />
    <link href="fonts/page-welcome/welcome-fonts.css" rel="stylesheet" type="text/css" media="all" />

    <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>

<body>

    <div id="wrapper1">
        <div id="header-wrapper">
            <div id="header" class="container">
                <div id="logo"> <span class="icon icon-truck"></span>
                    <h1>Passo Forte Distribuidora</h1>
                    <span>Gerenciamento de Estoque</span>
                </div>
                <div id="menu">
                    <ul>
                        <li class="current_page_item"><a href="{{ route('login') }}" accesskey="2" title="">Entrar</a>
                        </li>
                        {{-- <li class="current_page_item"><a href="{{ route('register') }}" accesskey="3"
                                title="">Cadastrar-se</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper2">
            <div id="welcome" class="container">
                <div class="title">
                    <h2>Seja bem-vindo</h2>
                </div>
                <p>Essa é a <strong>Passo Forte</strong> um software de gerenciamento de estoque para empresa que deseja
                    crescimento</a>. Nele você poderá administrar gastos, movimentações e claro, o controle do estoque
                    de produtos de sua empresa. Crie um cadastro e conheça um pouco melhor sobre este maravilhoso
                    software</a></p>
            </div>
        </div>

    </div>

</body>

</html>
