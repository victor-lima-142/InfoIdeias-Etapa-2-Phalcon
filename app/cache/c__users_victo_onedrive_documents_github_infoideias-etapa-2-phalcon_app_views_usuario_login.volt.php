<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Sistema de Notícias :: Infoidéias</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="<?= $this->url->getStatic('css/bootstrap.min.css') ?>" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="/css/styles.css" rel="stylesheet">
        <style>
            body{padding-top:20px;}
        </style>
</head>
<body class="login-img3-body">
    <div id="carregando">
        <img src="<?= $this->url->getStatic('img/loading.gif') ?>" alt="Carregando">
    </div>
    <div class="container">

        <img class="center-block login-img" src="/img/logoTopo.png" alt="Logo Infoidéias">
        <?= $this->tag->form(['', 'method' => 'post', 'class' => 'login-form']) ?>
            <div class="login-wrap">
                <h2>Sistema de Notícias</h2>

                <?= $this->flash->output(true) ?>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <?= $this->tag->emailField(['email', 'class' => 'form-control', 'placeholder' => 'E-mail', 'autofocus', 'required' => 'required', 'value' => $this->session->get('email')]) ?>
                    <?= $this->session->remove('email') ?>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <?= $this->tag->passwordField(['password', 'class' => 'form-control', 'placeholder' => 'Senha', 'required' => 'required', 'value' => '']) ?>
                </div>
                <div class="group-remember-me-forgot-my-password">
                    <label style="font-weight: 100">
                        <?= $this->tag->checkField(['remember_me', 'value' => 'S']) ?> <span>Continuar Conectado</span>
                    </label>
                    <label style="font-weight: 100" class="pull-right">
                        <a href="javascript:;" class="link-forgot-my-password"> Esqueci minha senha ></a>
                    </label>
                </div>

                <div id="div-btn-login" class="form-group" style="margin-top:15px">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" formaction="<?= $this->url->get(['for' => 'login']) ?>">Entrar</button>
                </div>

                <div id='div-btn-forgot-my-password' class="form-group hidden">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" formaction="<?= $this->url->get(['for' => 'usuario.esqueci-minha-senha']) ?>">Enviar Senha por Email</button>
                    <a href="#" class="btn btn-default btn-lg btn-block return-login hidden"><span class="glyphicon glyphicon-triangle-left"></span>Retornar ao Login</a>
                </div>
            </div>
        <?= $this->tag->endForm() ?>
    </div>

    
    <script src="<?= $this->url->getStatic('js/jquery-2.2.0.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            var $form            = $('form.login-form');
            var $passField       = $form.find('input[type=password].form-control');
            var $extraActions    = $form.find('.group-remember-me-forgot-my-password').first();
            var $localLogin      = $form.find('#div-btn-login');
            var $localForgot     = $form.find('#div-btn-forgot-my-password');
            var $btnRetornoLogin = $form.find('.return-login');

            $('.link-forgot-my-password').click(function(){
                $passField.prop('required', false);
                $passField.parent('div').addClass('hidden');
                $extraActions.addClass('hidden');
                $localLogin.addClass('hidden');
                $localLogin.children('button[type=submit]').prop('disabled', true);
                $localForgot.removeClass('hidden');
                $btnRetornoLogin.removeClass('hidden');
                $('div.alert').remove();
            });

            $('.return-login').click(function(){
                $passField.prop('required', true);
                $passField.parent('div').removeClass('hidden');
                $extraActions.removeClass('hidden');
                $localLogin.removeClass('hidden');
                $localLogin.children('button[type=submit]').prop('disabled', false);
                $localForgot.addClass('hidden');
                $btnRetornoLogin.addClass('hidden');
            });


            $('body').on('submit', 'form.login-form', function(){});
            $form.submit(function(){
                $('#carregando').css('display','block');
            });



        });

    </script>
</body>

</html>