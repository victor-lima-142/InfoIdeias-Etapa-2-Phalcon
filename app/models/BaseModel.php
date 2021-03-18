<?php

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class BaseModel extends Model
{
    protected static $_cache = array();

    const SIM = 'S';
    const NAO = 'N';

    public static function findFirst($params = null)
    {
        $chave = self::_criaChave($params);

        if (!isset(self::$_cache[$chave])) {
            self::$_cache[$chave] = parent::findFirst($params);
        }

        return self::$_cache[$chave];
    }

    public static function find($params = null)
    {
        $chave = self::_criaChave($params);

        if (!isset(self::$_cache[$chave])) {
            self::$_cache[$chave] = parent::find($params);
        }

        return self::$_cache[$chave];
    }

    public static function _criaChave($params)
    {
        if (is_array($params)) {
            $chave = array();

            foreach ($params as $param => $valor) {
                if (is_scalar($valor)) {
                    $chave[] = $param . ':' . $valor;
                } elseif (is_array($valor)) {
                    $chave[] = $param . ':[' . self::_criaChave($valor) . ']';
                }
            }

            return get_called_class() . '::' . join(',', $chave);
        }

        return get_called_class() . '::' . $params;
    }

    public static function queryPadrao($alias = null)
    {
        if (is_null($alias)) {
            $alias = get_called_class();
        }

        $query = new \Phalcon\Mvc\Model\Query\Builder();
        return $query->addFrom(get_called_class(), $alias);
    }

   

    
}