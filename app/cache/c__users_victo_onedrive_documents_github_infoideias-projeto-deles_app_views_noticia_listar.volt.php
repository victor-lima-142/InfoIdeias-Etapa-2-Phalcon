<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Sistema de Notícias :: Infoideías</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?= $this->url->getStatic('css/bootstrap.min.css') ?>" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?= $this->url->getStatic('css/styles.css') ?>" rel="stylesheet">
        <link href="<?= $this->url->getStatic('css/fileinput.min.css') ?>" rel="stylesheet">

        <link href="<?= $this->url->getStatic('css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">

        <link href="<?= $this->url->getStatic('css/font-awesome.min.css') ?>" rel="stylesheet">


        

	</head>
	<body>
        <div id="carregando">
            <img src="<?= $this->url->getStatic('img/loading.gif') ?>" alt="Carregando">
        </div>
        <header class="header">
            <div class="navbar navbar-default" id="subnav">
                <div class="col-md-12">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" id="logo">
                        <a id="link-logo" class="navbar-brand" href="<?= $this->url->get(['for' => 'noticia.lista']) ?>">
                            <img src="<?= $this->url->getStatic('img/logoTopo.png') ?>"  alt="Logo Infoidéias">
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
                                <a href="<?= $this->url->get(['for' => 'noticia.lista']) ?>">
                                    <i class="glyphicon glyphicon-home"></i>
                                   Página Inicial
                                </a>
                            </li>
                            <li class="active">
                                <a href="<?= $this->url->get(['for' => 'noticia.cadastrar']) ?>">
                                    <i class="glyphicon glyphicon-bullhorn"></i>
                                    Nova Noticia
                                </a>
                            </li>
                            
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Seja bem vindo(a), <?= $usuario->getNome() ?>
                                    <span class="caret"></span>

                                </a>
                                <ul class="dropdown-menu">
                                    
                                    <li><?= $this->tag->linkto([['for' => 'usuario.editar'], 'Alterar Senha']) ?></li>
                                    <li><?= $this->tag->linkto([['for' => 'logout'], 'Sair']) ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!--main-->
        <div class="container-fluid" id="main">

            <?= $this->flash->output(true) ?>

            
<div class="row">
    <div class="col-md-12" id="conteudo">
        <!-- <div class="col-md-6 col-sm-6"> -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- <a href="#" class="pull-right">View all</a> -->
                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                &nbsp;Notícias
                <form class="navbar-form navbar-right" id="search_ticket" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            <input id="dataTableSearch" type="text" class="form-control" placeholder="Search">
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a id="button-abrir-ticket" href="<?= $this->url->get(['for' => 'noticia.cadastrar']) ?>"
                        class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Nova
                        Noticia</a>

                </div>
                <table id="lista-noticia" class="table dataTable table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Cod</td>
                            <td class="text-center">Titulo</td>
                            <td class="text-center">Texto</td>
                            <td class="text-center">Ações</td>
                            <td class="text-center">Dt. Publicacao</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($noticias as $noticia) { ?>

                        <tr>
                            <td class="text-center"><a href="#"><?= $noticia->id ?></a></td>
                            <td class="titulo text-center"><?= $noticia->titulo ?></td>
                            <td class="text-center"><?= $noticia->texto ?></td>
                            <td class="text-center">
                                <a href="/noticias/editar/<?= $noticia->id ?>">
                                    <span class=" glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="/noticias/excluir/<?= $noticia->id ?>">
                                    <span class=" glyphicon glyphicon-remove-sign"></span>
                                </a>
                                <?php if ($noticia->publicado == 0) { ?>
                                <button class="btn btn-submit" value="<?= $noticia->id ?>" type="submit">
                                    <input type="checkbox" disabled value="<?= $noticia->id ?>">
                                </button>
                                <?php } ?>
                                <?php if ($noticia->publicado != 0) { ?>
                                <button class="btn btn-submit-despublica" value="<?= $noticia->id ?>" type="submit">
                                    <input type="checkbox" checked disabled value="<?= $noticia->id ?>">
                                </button>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if ($noticia->publicado == 0) { ?>
                                <span>Não publicado</span>
                                <?php } ?>
                                <?php if ($noticia->publicado != 0) { ?>
                                <?= $noticia->data_publicado ?>
                                <?php } ?>
                            </td>
                        </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div><!-- panel-body -->
        </div>
    </div>
</div><!-- row -->



            <div class="col-md-12 text-center">
                <p>Copyright 2015 - Todos os Direitos reservados. <a href="http://www.siteparaimobiliaria.imb.br/" target="_blank">Site para imobiliária Midas</a></p>
            </div>
        </div><!-- main -->
    	<!-- script references -->
		
        <script src="<?= $this->url->getStatic('js/jquery-2.2.0.min.js') ?>"></script>
		<script src="<?= $this->url->getStatic('js/bootstrap.min.js') ?>"></script>
		<script src="<?= $this->url->getStatic('js/scripts.js') ?>"></script>

        <script src="<?= $this->url->getStatic('js/jquery.maskedinput.min.js') ?>"></script>

        <script src="<?= $this->url->getStatic('js/jquery.validate.min.js') ?>"></script>
        <script src="<?= $this->url->getStatic('js/langs/messages_pt_PT.min.js') ?>"></script>


        <script src="<?= $this->url->getStatic('js/bootstrap-datetimepicker.min.js') ?>"></script>

        <script>
            $(document).ready(function(){
                $("span.fechar").click(function(){
                    $(this).parent('div').slideUp();
                });
            });

        </script>
		


<script>

    $(document).ready(function () {
        $('.btn-submit').click(function () {
            var direcao = '/noticias/publica/' + this.value;
            var idNoticia = this.value

            $.ajax({
                url: direcao,
                type: 'POST',
                data: {
                    id: idNoticia
                },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                },
                error: function (response) {
                    console.log(response)
                }
            });
            location.reload();
        });


        $(".btn-submit-despublica").click(function () {
            var direcao = '/noticias/despublica/' + this.value;
            var idNoticia = this.value
            $.ajax({
                url: direcao,
                type: 'POST',
                data: {
                    id: idNoticia
                },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                },
                error: function (response) {
                    console.log(response)
                }
            });
            location.reload();
        })
    });
</script>




	</body>
</html>