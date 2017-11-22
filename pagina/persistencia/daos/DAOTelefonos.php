<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/21/17
 * Time: 2:32 PM
 */

include_once(dirname(__FILE__).'/../../persistencia/Conexion.php');
include_once(dirname(__FILE__).'/../../persistencia/Consultas.php');
include_once(dirname(__FILE__).'/../../logica/objetos/Telefono.php');

class DAOTelefonos extends DAO
{
    private $cedulaUsuario;

    /**
     * DAOTelefonos constructor.
     * @param integer $idUsuario
     */
    public function __construct(int $cedulaUsuario)
    {
        parent::__construct();
        $this -> cedulaUsuario = $cedulaUsuario;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @return integer
     */
    public function getCedulaUsuario()
    {
        return $this -> cedulaUsuario;
    }

    /**
     * @param integer $cedulaUsuario
     */
    public function setCedulaUsuario(int $cedulaUsuario)
    {
        $this -> cedulaUsuario = $cedulaUsuario;
    }

    public function largo(Conexion $con)
    {
        $ret = 0;

        return $ret;
    }

    public function insback(Conexion $con, Telefono $telefono)
    {
        // TODO implementar metodo.
    }

    public function delete(Conexion $con, int $idTelefono)
    {
        // TODO implementar metodo.
    }

    public function listarTelefonos(Conexion $con)
    {
        // TODO implementar metodo.
    }

}