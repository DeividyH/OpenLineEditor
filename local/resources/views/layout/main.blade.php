<!DOCTYPE html>
<html>

<head>
	<title>OpenLineEditor</title>
	<link rel="shortcut icon" href="{!! asset('images/olg_logo.png') !!}">

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        {!! Html::script("js/jquery-2.2.1.min.js") !!}

        {!! Html::style("css/bootstrap.min.css") !!}
        {!! Html::script("js/bootstrap.min.js") !!}

        {!! Html::style("css/basic-ui.css") !!}
        {!! Html::script("js/basic-ui.js") !!}

        {!! Html::style("css/style.css") !!}

				{!! Html::style("css/leaflet.css") !!}
				{!! Html::script("js/leaflet.js") !!}

        {!! Html::style("css/leaflet-geocoder-mapzen.css") !!}
        {!! Html::script("js/leaflet-geocoder-mapzen.js") !!}

        {!! Html::script("js/index.js") !!}

				<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		    <!--[if lt IE 9]>
		      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
		      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		    <![endif]-->
</head>

<body>

    <div id="topo">
        <div id="conteudo-topo">
            <div id="logo">
                <a href="{!! URL::to('/') !!}">
                        <img src="{!! asset('images/olg_logo.png') !!}" />
                        <p>OpenLineEditor</p>
                </a>
            </div>

            <div id="menu-principal">
                    <ul>
                            <a href="{!! URL::to('/export') !!}"><li>Importar</li></a>
                            <a href="{!! URL::to('/export') !!}"><li>Exportar</li></a>
                            <a href="{!! URL::to('/contact') !!}"><li>Contato</li></a>
                            @if(Auth::check())
                                <a href="{!! URL::to('/painel') !!}"><li>Painel</li></a>
                            @else
                                <a href="{!! URL::to('/login/create') !!}"><li>Entrar</li></a>
                                <a href="{!! URL::to('/user/create') !!}"><li>Criar Conta</li></a>
                            @endif
                    </ul>
            </div>
        </div>
    </div>

    <div id="conteudo-geral">

        @yield("conteudo-pagina")

    </div>

</body>

</html>
