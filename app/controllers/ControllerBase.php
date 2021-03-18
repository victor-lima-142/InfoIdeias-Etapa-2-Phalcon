<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{


    public function initialize()
    {

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $controllerAtual = $this->dispatcher->getControllerName();
        $actionAtual     = $this->dispatcher->getActionName();

        if(!$this->session->has('auth') && $this->cookies->has('auth')){
            if($this->cookies->get('auth') != false){
                $sessao = json_decode(base64_decode($this->cookies->get('auth')->getValue()), true);
                $this->session->set('auth', $sessao);
            }
        }

        if ($this->session->has('auth')) {

           
            $this->Usuario = new Usuario();
            $this->Usuario->find([
                'conditions' => "id = :id:",
                'bind'       => ['id'=>$this->session->get('auth')['id']]
            ])->getFirst();

            $this->view->usuario = $this->Usuario;

        } elseif (!$this->session->has('auth') && $controllerAtual != 'Index' && $actionAtual != 'Index' && $this->request->isMethod('GET')) {
            echo $this->view->getRender('usuario', 'login');
            die;
        }

        if($this->request->hasQuery('redirect') || $this->cookies->has('redirect')){

            if($this->request->hasQuery('redirect')){
                $url_redirect = $this->request->getQuery('redirect');
            }else{
                $url_redirect = $this->cookies->get('redirect')->getValue();

                if($this->session->has('auth'))
                    $this->cookies->set('redirect', false);
            }

            if($url_redirect != false){
                if($this->session->has('auth')){
                    return $this->response->redirect('http://' . $this->request->getServer('SERVER_NAME') . $url_redirect);
                } else {
                    $this->cookies->set('redirect', $url_redirect);
                }
            }
        }


        if($this->session->has('auth') && $controllerAtual == 'Index' && $actionAtual == 'index'){
            return $this->response->redirect(['for' => 'noticia.lista']);
        }
    }

    
}
