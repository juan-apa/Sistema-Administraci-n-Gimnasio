<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/27/17
 * Time: 9:25 AM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');
include_once(dirname(__FILE__).'/Controladora.php');



class ControladoraInicio extends Controladora
{
    private $f = null;
    private $rol = '';
    private $user = null;

    public function __construct()
    {
        session_start();
        try
        {
            $this -> f = new Fachada();
            $this -> user = $_SESSION['usuario'];
            if(isset($this -> user))
            {
                $this -> rol = $this -> f -> obtenerRolUsuario($this -> user -> getCedula());
            }
            else
            {
                $this -> rol = Rol::obtenerRolDeIdRol(Rol::PUBLICO);
            }
        }
        catch (Exception $e)
        {
            echo "<script>alert('Error: ".$e->getMessage()."')</script>";
        }
    }
}