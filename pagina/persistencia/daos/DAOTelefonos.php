<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/21/17
 * Time: 2:32 PM
 */

class DAOTelefonos extends DAO
{
    private $idUsuario;

    /**
     * DAOTelefonos constructor.
     * @param integer $idUsuario
     */
    public function __construct(int $idUsuario)
    {
        parent::__construct();
        $this -> idUsuario = $idUsuario;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this -> idUsuario;
    }

    /**
     * @param integer $idUsuario
     */
    public function setIdUsuario(int $idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }


}