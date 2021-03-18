<?php



use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Categoria extends Model
{
    private $id;
    private $nome;

    public function getSource()
    {
        return 'cat_not';
    }

    /**
     * Uma noticia pertence
     */
    public function initialize()
    {
        $this->belongsTo('id_categoria', 'cat_not', 'id');
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}