<?php



use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Noticia extends Model
{
    private $id;
    private $titulo;
    private $texto;
    private $data_ultima_atualizacao;
    private $data_cadastro;
    private $data_publicado;
    private $publicado;

    public function getSource()
    {
        return 'noticia';
    }

    /**
     * Uma noticia pertence
     */
    public function initialize()
    {
        $this->belongsTo('id_noticia', 'cat_not', 'id');
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function getDataUltimaAtualizacao()
    {
        return $this->data_ultima_atualizacao;
    }

    public function setDataUltimaAtualizacao($data)
    {
        $this->data_ultima_atualizacao = $data;
    }

    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    public function setDataCadastro($data)
    {
        $this->data_cadastro = $data;
    }

    public function getPublicado()
    {
        return $this->publicado;
    }

    public function setPublicado($numero)
    {
        $this->publicado = $numero;
    }

    public function getDataPublicado()
    {
        return $this->data_publicado;
    }

    public function setDataPublicado($data)
    {
        $this->data_publicado = $data;
    }
    
}