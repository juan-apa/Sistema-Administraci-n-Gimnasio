<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/1/17
 * Time: 7:15 PM
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
        $fac -> bajaUsuario($cedula);
        $ok = 1;
        $mensaje = "Usuario dado de baja con éxito.";
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

header('location: ./../bajaUsuario.php?ok='.$ok.'&mensaje='.$mensaje);