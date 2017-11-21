<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 11:42 PM
 */

include_once(dirname(__FILE__).'/DAO.php');
include_once(dirname(__FILE__).'/../../logica/objetos/Rutina.php');

class DAORutinas extends DAO
{
    private $idUsuario;

    public function __construct($idUsuario)
    {
        parent::__construct();
        $this -> idUsuario = $idUsuario;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function largo()
    {
        // TODO implementar el metodo
    }

    public function insBack(Rutina $rutina)
    {
        // TODO implementar el metodo
    }

    public function delete($idRutina)
    {
        // TODO implementar el metodo
    }

    public function listarRutina()
    {
        // TODO implementar el metodo
    }

    public function k_esimo($idRutina)
    {
        // TODO implementar el metodo
    }

    public function modify($idRutina, Rutina $rutina)
    {
        // TODO implementar el metodo
    }

}