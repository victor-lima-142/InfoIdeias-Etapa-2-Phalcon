<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;

class NoticiaController extends ControllerBase
{
    public function listaAction()
    {
        $noticias = Noticia::find();
        $this->view->setVar('noticias', $noticias);
        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        $categorias = Categoria::find();
        $this->view->setVar('categorias', $categorias);
        $this->view->pick("noticia/cadastrar");
    }

    public function valida($request)
    {
        $titulo = $this->request->getPost('titulo');
        $texto = $this->request->getPost('texto');
        if (!empty($titulo)) {
            return true;
        } else if ($texto <= 255) {
            return true;
        } else {
            return false;
        }
    }

    public function editarAction($id)
    {
        $dados = Noticia::find($id);
        $categorias = Categoria::find();

        $this->view->setVar('categorias', $categorias);
        $this->view->setVar('dados', $dados);
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        if ($this->request->isPost()) {
            $request = $this->request;
            $validacao = $this->valida($request);

            $titulo = $this->request->getPost('titulo');
            $texto = $this->request->getPost('texto');
            $idCategoria = $this->request->getPost('categoria');
            $dateTime = date('Y-m-d H:i:s');

            if (!$validacao) {
                $this->flash->error('Não foi possível cadastrar a notícia. Lembre-se: o título é obrigatório e o texto deve ter no máximo 255 caracteres.');
                return $this->response->redirect(array('for' => 'noticia.cadastrar'));
            } else {
                if ($idCategoria > 0) {
                    try {
                        $noticia = new Noticia();
                        $noticia->titulo = $titulo;
                        $noticia->texto = $texto;
                        $noticia->data_ultima_atualizacao = $dateTime;
                        $noticia->data_cadastro = $dateTime;
                        $result = $noticia->save();
                        $idNoticia = $noticia->id;

                        $juncao = new CategoriaNoticia();
                        $juncao->id_noticia = $idNoticia;
                        $juncao->id_categoria = $idCategoria;
                        $juncao->save();


                        $this->flash->success('Criada a notícia ' . $titulo);
                        return $this->response->redirect(array('for' => 'noticia.lista'));
                    } catch (Exception $exception) {
                        $this->flash->error('Não foi possível cadastrar a notícia. Erro interno: ' . $exc->getMessage());
                        return $this->response->redirect(array('for' => 'noticia.cadastrar'));
                    }
                } else {
                    $this->flash->error('É necessário ao menos 1 categoria');
                    return $this->response->redirect(array('for' => 'noticia.cadastrar'));
                }
            }
        } else {
            $this->flash->error('Não foi possível cadastrar a notícia. Erro interno');
            return $this->response->redirect(array('for' => 'noticia.cadastrar'));
        }
    }

    public function atualizaAction()
    {
        if ($this->request->isPost()) {
            $request = $this->request;
            $validacao = $this->valida($request);
            $idCategoria = $this->request->getPost('categoria');
            $idCategoria = intval($idCategoria);
            $id = $this->request->getPost('id');
            $titulo = $this->request->getPost('titulo');
            $texto = $this->request->getPost('texto');
            $dateTime = date('Y-m-d H:i:s');
            if ($texto > 255) {
                $this->flash->error('Não foi possível cadastrar a notícia. Lembre-se: o título é obrigatório e o texto deve ter no máximo 255 caracteres.');
                return $this->response->redirect(array('for' => 'noticia.cadastrar'));
            } else {
                if (!$validacao) {
                    $this->flash->error('Não foi possível cadastrar a notícia. Lembre-se: o título é obrigatório e o texto deve ter no máximo 255 caracteres.');
                    return $this->response->redirect(array('for' => 'noticia.cadastrar'));
                } else {
                    try {
                        $dadosAntigos = Noticia::find($id);
                        foreach ($dadosAntigos as $value) {
                            $data_cadastrado = $value->data_cadastro;
                            $foi_publicado = $value->publicado;
                            $data_publicado = $value->data_publicado;
                        }
                        $noticia = new Noticia();
                        $noticia->id = $id;
                        $noticia->titulo = $titulo;
                        $noticia->texto = $texto;
                        $noticia->data_ultima_atualizacao = $dateTime;
                        $noticia->data_cadastro = $data_publicacao;
                        $noticia->publicado = $foi_publicado;
                        $noticia->data_publicado = $data_publicado;
                        $noticia->save();

                        if ($idCategoria > 0) {
                            $juncao = new CategoriaNoticia();
                            $juncao->id_noticia = $id;
                            $juncao->id_categoria = $idCategoria;
                            $juncao->save();
                        } else {
                            //
                        }

                        $this->flash->success('Atualizada a notícia ' . $titulo);
                        return $this->response->redirect(array('for' => 'noticia.lista'));
                    } catch (Exception $exception) {
                        $this->flash->error('Não foi possível cadastrar a notícia. Erro interno: ' . $exc->getMessage());
                        return $this->response->redirect(array('for' => 'noticia.cadastrar'));
                    }
                }
            }
        } else {
            $this->flash->error('Não foi possível cadastrar a notícia. Erro interno');
            return $this->response->redirect(array('for' => 'noticia.cadastrar'));
        }
    }

    public function excluirAction($id)
    {
        try {
            try {
                $query = $this->modelsManager->createQuery('SELECT * FROM cat_not WHERE id_noticia = ' . $id);
                $juncoes  = $query->execute();
                foreach ($juncoes as $value) {
                    $idParaExcluir = $value->id;
                    $categoria_noticia = CategoriaNoticia::findFirst($idParaExcluir);
                    $categoria_noticia->delete($idParaExcluir);
                }
            } catch (Exception $erro) {
                $this->flash->error('Não foi possível excluir. Erro interno: ' . $erro->getMessage());
                return $this->response->redirect(array('for' => 'noticia.cadastrar'));
            }

            $noticia = Noticia::findFirst($id);
            $noticia->delete($id);
            return $this->response->redirect(array('for' => 'noticia.lista'));
        } catch (Error $exc) {
            $this->flash->error('Não foi possível excluir. Erro interno: ' . $exc->getMessage());
            return $this->response->redirect(array('for' => 'noticia.cadastrar'));
        }
    }

    public function publicaAction($id)
    {
        try {
            $noticia = Noticia::findFirst($id);
            $titulo = $noticia->titulo;
            $texto = $noticia->texto;
            $atualizacao = $noticia->data_ultima_atualizacao;
            $cadastro = $noticia->data_cadastro;

            $dateTime = date('Y-m-d H:i:s');
            $noticiaPublicada = new Noticia();
            $noticiaPublicada->id = $id;
            $noticiaPublicada->titulo = $titulo;
            $noticiaPublicada->texto = $texto;
            $noticiaPublicada->data_ultima_atualizacao = $atualizacao;
            $noticiaPublicada->data_cadastro = $cadastro;
            $noticiaPublicada->publicado = 1;
            $noticiaPublicada->data_publicado = $dateTime;
            $noticiaPublicada->save();

            return "publicado";
        } catch (Exception $e) {
            return $e->getMessage() . "  -  " . $e->getFile() . " - " . $e->getLine();
        }
    }

    public function despublicaAction($id)
    {
        $noticia = Noticia::findFirst($id);
        $titulo = $noticia->titulo;
        $texto = $noticia->texto;
        $atualizacao = $noticia->data_ultima_atualizacao;
        $cadastro = $noticia->data_cadastro;
        $publicacao = $noticia->data_publicado;

        $dateTime = date('Y-m-d H:i:s');
        $noticiaPublicada = new Noticia();
        $noticiaPublicada->id = $id;
        $noticiaPublicada->titulo = $titulo;
        $noticiaPublicada->texto = $texto;
        $noticiaPublicada->data_ultima_atualizacao = $atualizacao;
        $noticiaPublicada->data_cadastro = $cadastro;
        $noticiaPublicada->publicado = 0;
        $noticiaPublicada->data_publicado = $publicacao;
        $noticiaPublicada->save();

        $this->flash->success('A noticia ' . $titulo . " foi despublicada.");
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }
}
