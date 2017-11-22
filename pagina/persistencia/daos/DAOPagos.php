<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/22/17
 * Time: 9:20 AM
 */

include_once(dirname(__FILE__).'/DAO.php');
include_once(dirname(__FILE__).'/../Consultas.php');

class DAOPagos extends DAO
{
    private $cedulaUsuario;
    public function __construct(int $cedulaUsuario)
    {
        parent::__construct();
        $this -> cedulaUsuario = $cedulaUsuario;
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}