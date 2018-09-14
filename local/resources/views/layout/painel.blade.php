<!DOCTYPE html>
<html lang="pt">

<head>
	<title>OpenLineEditor</title>
	<link rel="shortcut icon" href="{!! asset('images/olg_logo.png') !!}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="{{ URL::to('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    {!! Html::style("css/basic-ui.css") !!}
    {!! Html::style("css/style.css") !!}
    {!! Html::style("css/bootstrap.min.css") !!}
    {!! Html::style("css/sb-admin.css") !!}
    {!! Html::style("font-awesome/css/font-awesome.min.css") !!}
    {!! Html::script("js/jquery-2.2.1.min.js") !!}

		{!! Html::style("css/leaflet.css") !!}
		{!! Html::script("js/leaflet.js") !!}

    {!! Html::style("css/leaflet-geocoder-mapzen.css") !!}
    {!! Html::script("js/leaflet-geocoder-mapzen.js") !!}

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{!! URL::to('/painel') !!}">
                    <div>
                        <div id="logo-user-painel"></div>
                        &nbsp&nbsp&nbsp&nbsp&nbsp
                        OpenLineEditor: Painel do Usuário
                    </div>
                </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li>
                    <a href="{!!URL::to('/')!!}"><i class="fa fa-reply"></i> Voltar ao início</a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  {!! Auth::user()->name !!} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <!--
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        -->
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Configurações </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{!! URL::to('/logout') !!}"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{!! URL::to('/painel') !!}"><i class="fa fa-bus"></i> Minhas Linhas</a>
                    </li>
                    <li>
                        <a href="{!! URL::to('/painel/lines') !!}"><i class="fa fa-exchange"></i> Todas as Linhas</a>
                    </li>
                    <li>
                        <a href="{!! URL::to('/painel/agency/create') !!}"><i class="fa fa-fw fa-edit"></i> Cadastrar Empresa</a>
                    </li>
                    <li>
                        <a href="{!! URL::to('/painel/route/create') !!}"><i class="fa fa-level-up"></i> Criar Linha</a>
                    </li>
                    <li>
                        <a href="{!! URL::to('/painel/tutorial') !!}"><i class="fa fa-question"></i> Tutorial</a>
                    </li>
                    <!--
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            @yield('conteudo-pagina')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    {!! Html::script("js/bootstrap.min.js") !!}

</body>

</html>
