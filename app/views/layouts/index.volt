<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Sistema de Notícias :: Infoideías</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="{{ static_url("css/bootstrap.min.css") }}" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="{{ static_url("css/styles.css") }}" rel="stylesheet">
        <link href="{{ static_url("css/fileinput.min.css") }}" rel="stylesheet">

        <link href="{{ static_url("css/bootstrap-datetimepicker.min.css") }}" rel="stylesheet">

        <link href="{{ static_url("css/font-awesome.min.css") }}" rel="stylesheet">


        {% block extrahead %}{% endblock %}

	</head>
	<body>
        <div id="carregando">
            <img src="{{ static_url("img/loading.gif") }}" alt="Carregando">
        </div>
        <header class="header">
            <div class="navbar navbar-default" id="subnav">
                <div class="col-md-12">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" id="logo">
                        <a id="link-logo" class="navbar-brand" href="{{ url(['for':'noticia.lista']) }}">
                            <img src="{{ static_url("img/logoTopo.png") }}"  alt="Logo Infoidéias">
                        </a>
                    </div>
                    <div class="col-lg-3 hidden-md hidden-sm hidden-xs" id="logo">
                        <h1>Sistema de Noticias</h1>
                    </div>
                    <div class="navbar-header col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse2">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active">
                                <a href="{{ url(['for':'noticia.lista']) }}">
                                    <i class="glyphicon glyphicon-home"></i>
                                   Página Inicial
                                </a>
                            </li>
                            <li class="active">
                                <a href="{{ url(['for':'noticia.cadastrar']) }}">
                                    <i class="glyphicon glyphicon-bullhorn"></i>
                                    Nova Noticia
                                </a>
                            </li>
                            
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Seja bem vindo(a), {{ usuario.getNome() }}
                                    <span class="caret"></span>

                                </a>
                                <ul class="dropdown-menu">
                                    {#<li><a href="index.html">Alterar Cadastro</a></li>#}
                                    <li>{{ linkTo([['for':'usuario.editar'], 'Alterar Senha']) }}</li>
                                    <li>{{ linkTo([['for':'logout'], 'Sair']) }}</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!--main-->
        <div class="container-fluid" id="main">

            {{ flash.output(true) }}

            {% block content %}{% endblock %}

            <div class="col-md-12 text-center">
                <p>Copyright 2015 - Todos os Direitos reservados. <a href="http://www.siteparaimobiliaria.imb.br/" target="_blank">Site para imobiliária Midas</a></p>
            </div>
        </div><!-- main -->
    	<!-- script references -->
		{#<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>#}
        <script src="{{ static_url("js/jquery-2.2.0.min.js") }}"></script>
		<script src="{{ static_url("js/bootstrap.min.js") }}"></script>
		<script src="{{ static_url("js/scripts.js") }}"></script>

        <script src="{{ static_url("js/jquery.maskedinput.min.js") }}"></script>

        <script src="{{ static_url("js/jquery.validate.min.js") }}"></script>
        <script src="{{ static_url("js/langs/messages_pt_PT.min.js") }}"></script>


        <script src="{{ static_url("js/bootstrap-datetimepicker.min.js") }}"></script>

        <script>
            $(document).ready(function(){
                $("span.fechar").click(function(){
                    $(this).parent('div').slideUp();
                });
            });

        </script>
		{% block extrafooter %}{% endblock %}

	</body>
</html>