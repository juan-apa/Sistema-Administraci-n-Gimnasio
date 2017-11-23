<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/23/17
 * Time: 10:14 AM
 */
echo "1";
include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAORutinas.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOPagos.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOTelefonos.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');
echo "2";


$cedula = $_POST['cedula'];
$password = $_POST['password'];

$ok = 0;
$mensaje = "";

if(isset($cedula, $password)){
    echo "3";
    try{
        $fac = new Fachada();
        echo "4";
        $fac -> loginUsuario((int) $cedula, $password);

        echo "5";
        $ok = 1;
        $mensaje = "Inicio de sesion exitoso.";
    }
    catch (Exception $e)
    {
        echo "6";
        $mensaje = $e -> getMessage();
    }
}
else
{
    echo "7";
    $mensaje = "Los campos cedula y contrasenia tienen que tener datos.";
}
echo "ok: ".$ok;
echo "mensaje: ".$mensaje;
/*Redirecciono adecuadamente si es que pudo iniciar sesion o no.*/
if($ok)
{
    header('location: ./../index.php?ok='.$ok.'&mensaje='.$mensaje);
}
else
{
    header('location: ./../login.php?ok='.$ok.'&mensaje='.$mensaje);
}

?>