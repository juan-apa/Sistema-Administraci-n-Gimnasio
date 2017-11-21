<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 11:48 PM
 */

include_once(dirname(__FILE__).'/../../logica/objetos/Ejercicio.php');

class DAOEjercicios extends DAO
{
    private $idRutina;

    public function __construct($idRutina)
    {
        parent::__construct();
        $this -> idRutina = $idRutina;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function largo()
    {
        //TODO implementar metodo
    }

    public function insback(Ejercicio $ejercicio)
    {
        //TODO implementar metodo
    }

    public function delete($idEjercicio)
    {
        //TODO implementar metodo
    }

    public function listarEjercicios()
    {
        //TODO implementar metodo
    }

    public function k_esimo($idEjercicio)
    {
        //TODO implementar metodo
    }

    public function modify($idEjercicio, Ejercicio $ejercicio)
    {
        //TODO implementar metodo
    }

}