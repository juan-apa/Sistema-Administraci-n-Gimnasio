<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/6/17
 * Time: 9:57 PM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPago.php');

$ok = 0;
$mensaje = "";

$cedula = $_POST['cedula'];
$idPago = $_POST['idPago'];

if(isset($cedula, $idPago))
{
    try{
        $fac = new Fachada();
        $fac -> bajaPago($cedula, $idPago);
        $ok = 1;
        $mensaje = "Pago dado de baja con éxito.";
    } catch (Exception $e){
        $ok = 0;
        $mensaje = $e -> getMessage();
    }
}
else
{
    $ok = 0;
    $mensaje = "El campo cedula o ID pago se encuentra vacío.";
}

header('location: ./../bajaPago.php?ok='.$ok.'&mensaje='.$mensaje);