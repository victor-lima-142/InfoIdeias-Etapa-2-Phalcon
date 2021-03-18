<?php



use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CategoriaNoticia extends Model
{
    private $id_juncao;
    private $id_noticia;
    private $id_categoria;

    public function getSource()
    {
        return 'cat_not';
    }

    /**
     * Uma noticia pertence
     */
    public function initialize()
    {
        $this->hasMany('id', 'noticia', 'id_noticia');
        $this->hasMany('id', 'categoria', 'id_categoria');
    }


    public function getIdJuncao()
    {
        return $this->id_juncao;
    }

    public function setIdJuncao($id_juncao)
    {
        $this->id_juncao = $id_juncao;
    }

    public function getIdNoticia()
    {
        return $this->id_noticia;
    }

    public function setIdNoticia($idNoticia)
    {
        $this->id_noticia = $idNoticia;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
}