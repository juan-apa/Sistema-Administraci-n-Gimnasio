<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/4/17
 * Time: 9:53 AM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');

$ok = 0;
$mensaje = "";

$cedula = $_POST['cedula'];

if(isset($cedula))
{
    try{
        $fac = new Fachada();
        $fac -> altaUsuario($cedula);
        $ok = 1;
        $mensaje = "Usuario dado de alta con éxito.";
    } catch (Exception $e){
        $ok = 0;
        $mensaje = $e -> getMessage();
    }
}
else
{
    $ok = 0;
    $mensaje = "El campo cedula se encuentra vacío.";
}

header('location: ./../altaUsuario.php?ok='.$ok.'&mensaje='.$mensaje);