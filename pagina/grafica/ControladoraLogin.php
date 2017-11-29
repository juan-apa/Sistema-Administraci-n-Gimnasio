<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/23/17
 * Time: 10:14 AM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAORutinas.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOPagos.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOTelefonos.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');
include_once(dirname(__FILE__).'/../logica/objetos/Rol.php');
include_once(dirname(__FILE__). '/Controladora.php');

class ControladoraLogin extends Controladora
{
    private $cedula;
    private $password;
    private $ok;
    private $mensaje;

    public function __construct()
    {
        parent::__construct();
        $this -> ok = 0;
        $this -> mensaje = "";

        $this -> cedula = $_POST['cedula'];
        $this -> password = $_POST['password'];

        if(isset($this -> cedula, $this -> password)){
            try{
                parent::getF() -> loginUsuario((int) $this -> cedula, $this -> password);
                $this -> ok = 1;
                $this -> mensaje = "Inicio de sesion exitoso.";
            }
            catch (Exception $e)
            {
                $this -> mensaje = $e -> getMessage();
            }
        }
        else
        {
            $this -> mensaje = "Los campos cedula y contrasenia tienen que tener datos.";
        }
    }

    public function redireccionamiento(): void
    {
        /*Redirecciono adecuadamente si es que pudo iniciar sesion o no.*/
        if($this -> ok)
        {
            header('location: ./../index.php?ok='.$this -> ok.'&mensaje='.$this -> mensaje);
        }
        else
        {
            header('location: ./../login.php?ok='.$this -> ok.'&mensaje='.$this -> mensaje);
        }
    }
}


/*Lo que se ejecuta cuando se llama al archivo.*/
$con = new ControladoraLogin();
/*Redirecciono adecuadamente*/
$con -> redireccionamiento();

?>