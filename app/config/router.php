<?php
use \Phalcon\Mvc\Router;

$router = new Router(false);
$router->removeExtraSlashes(true);


$router->notFound(array('controller' => 'Index', 'action'=>'notFound'));

$router->addPost("/login",                      array("controller" => "usuario",  "action"          => "login" ))->setName('login');
$router->addGet("/logout",                      array("controller" => "usuario",  "action"          => "logout"))->setName('logout');
$router->addGet("/usuario/editar/{id:[0-9]*}",  array("controller" => "usuario",  "action"          => "editar"))->setName('usuario.editar');
$router->add("/usuario/editar",                 array("controller" => "usuario",  "action"          => "editar"))->setName('usuario.editar');


$router->add("/", array( "controller" => "Index", "action"     => "index"))->setName('index.index');
$router->add("/noticias",                        array("controller" => "Noticia", "action"          => "lista"))->setName('noticia.lista');
$router->add("/noticias/cadastrar",              array("controller" => "Noticia", "action"           => "cadastrar"))->setName('noticia.cadastrar');
$router->addGet("/noticias/editar/{id:[0-9]*}",  array("controller" => "Noticia",  "action"          => "editar"))->setName('noticia.editar');
$router->add("/noticias/editar",                 array("controller" => "Noticia",  "action"          => "editar"))->setName('noticia.editar');
$router->addPost("/noticias/salvar",             array("controller" => "Noticia", "action"           => "salvar"))->setName('noticia.salvar');
$router->addPost("/noticias/atualiza",             array("controller" => "Noticia", "action"           => "atualiza"))->setName('noticia.atualizar');
$router->addPost("/noticias/publica/{id:[0-9]*}",             array("controller" => "Noticia", "action"           => "publica"))->setName('noticia.publicar');
$router->addPost("/noticias/despublica/{id:[0-9]*}",             array("controller" => "Noticia", "action"           => "despublica"))->setName('noticia.despublicar');
$router->addGet("/noticias/excluir/{id:[0-9]*}",  array("controller" => "Noticia",  "action"          => "excluir"))->setName('noticia.excluir');


return $router;