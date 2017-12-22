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

    public function largo(Conexion $con): int
    {
        // TODO implementar el metodo
    }

    public function insBack(Conexion $con, Rutina $rutina): void
    {
        // TODO implementar el metodo
    }

    public function delete(Conexion $con, int $idRutina): void
    {
        // TODO implementar el metodo
    }

    public function listarRutina(Conexion $con): array
    {
        // TODO implementar el metodo
    }

    public function k_esimo(Conexion $con, int $idRutina): Rutina
    {
        // TODO implementar el metodo
    }

    public function modify(Conexion $con, int $idRutina, Rutina $rutina): void
    {
        // TODO implementar el metodo
    }

}