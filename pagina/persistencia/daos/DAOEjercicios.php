<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 11:48 PM
 */

include_once(dirname(__FILE__).'/DAO.php');
include_once(dirname(__FILE__).'/../../logica/objetos/Ejercicio.php');
include_once(dirname(__FILE__).'/../Consultas.php');

class DAOEjercicios extends DAO
{
    private $idRutina;

    public function __construct(int $idRutina)
    {
        parent::__construct();
        $this -> idRutina = $idRutina;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function largo(Conexion $con)
    {
        //TODO implementar metodo
    }

    public function insback(Conexion $con, Ejercicio $ejercicio)
    {
        //TODO implementar metodo
    }

    public function delete(Conexion $con, int $idEjercicio)
    {
        //TODO implementar metodo
    }

    public function listarEjercicios(Conexion $con)
    {
        //TODO implementar metodo
    }

    public function k_esimo(Conexion $con, int $idEjercicio)
    {
        //TODO implementar metodo
    }

    public function modify(Conexion $con, int $idEjercicio, Ejercicio $ejercicio)
    {
        //TODO implementar metodo
    }

}