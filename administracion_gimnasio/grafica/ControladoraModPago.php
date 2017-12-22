<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/6/17
 * Time: 7:28 PM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../logica/objetos/Pago.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPago.php');

$cedula = $_POST['cedulaUsuario'];
$fechaPago = $_POST['fechaPago'];
$monto = $_POST['monto'];
$tipoPago = $_POST['tipoPago'];
$idPago = $_POST['idPago'];

if(isset($cedula, $fechaPago, $monto, $tipoPago))
{
    try{
        $fac = new Fachada();
        $fac -> modificacionPago($cedula, $idPago, $fechaPago, $tipoPago, $monto);
        $ok = 1;
        $mensaje = "Pago modificado con éxito.";
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

header('location: ./../modificacionPago.php?ok='.$ok.'&mensaje='.$mensaje);
