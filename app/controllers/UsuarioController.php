<?php

use Phalcon\Http\Request;

class UsuarioController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function loginFormAction()
    {

        $this->view->pick("usuario/login");

    }
    public function loginAction()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Find the user in the database
        $usuario = Usuario::findFirst(
                array(
                    "(email = :email:) AND senha = :password:",
                    'bind' => array(
                        'email'    => $email,
                        'password' => $password
                    )
                )
        );

        if ($usuario != false) {

            $this->_registerSession($usuario, $this->request->has('remember_me'));
            return $this->response->redirect(['for' => 'noticia.lista']);

        }

        $this->flash->error('E-mail e/ou senha não foram preenchidos corretamente');
        $this->session->set('email', $email);
        return $this->response->redirect(['for' => 'index.index']);


    }
    private function _registerSession($usuario, $remember = false)
    {
        $sessao = array(
            'id'                => $usuario->getId(),
            'nome'              => $usuario->getNome(),
            
        );
        $this->session->set('auth', $sessao);

        if($remember){
            $cookie = base64_encode(json_encode($sessao));

            $this->cookies->set('auth', $cookie, time() + (14 * 24 * 60 * 60)); // 2 semanas

        }
    }

   public function logoutAction()
    {

        $this->session->remove("auth");
        $this->cookies->set("auth", false);

        return $this->response->redirect(array('for' => 'index.index'));

    }
    
}
