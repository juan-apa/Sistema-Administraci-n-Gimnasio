<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/30/17
 * Time: 8:27 PM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAORutinas.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOPagos.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOTelefonos.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');

$cedVieja = $_POST['cedVieja'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$direccion = $_POST['direccion'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$socMedica = $_POST['socMedica'];
$emerMovil = $_POST['emerMovil'];
$antecedentes = $_POST['antecedentes'];
$observaciones = $_POST['observaciones'];
$rol = $_POST['rol'];

$ok = 0;
$mensaje = "";

if(isset($nombre, $apellido, $cedula, $direccion, $fechaNacimiento, $socMedica, $emerMovil, $cedVieja)){
    if(!empty($antecedentes)){
        $antecedentes = trim($antecedentes);
    }
    if(!empty($observaciones)){
        $observaciones = trim($observaciones);
    }


    $user = new Usuario(0, $nombre, $apellido, (int) $cedula, $direccion, $fechaNacimiento, $socMedica, $emerMovil, $antecedentes, $observaciones, 1, $rol, $cedula);
    try{
        $fac = new Fachada();
        echo "<script>alert('fac creada');</script>";
        $fac -> modificarUsuario((int) $cedVieja, $user);
        echo "<script>alert('modificarUsuario');</script>";
        $mensaje = "Usuario modificado con exito.";
        $ok = 1;
    } catch (Exception $e){
        echo "<script>alert('ExceptionContModUsuario: ".$e -> getMessage()."');</script>";
        $mensaje = $e -> getMessage();
        $ok = 0;
    }
}
header('location: ./../modificacionUsuario.php?ok='.$ok.'&mensaje='.$mensaje);