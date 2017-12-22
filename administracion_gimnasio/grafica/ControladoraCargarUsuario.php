<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/27/17
 * Time: 11:10 AM
 */

include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');
include_once(dirname(__FILE__).'/Controladora.php');
session_start();
$mensaje = "";
$ok = 0;

$cedula = $_POST['cedVieja'];

try
{
    $con = new Controladora();
    echo "<script>alert('antes obtener: ".$cedula."');</script>";
    $_SESSION['usuarioViejo'] = $con -> getF() -> obtenerUsuario((int) $cedula);
    echo "<script>alert('Luego obtener');</script>";
    $ok = 1;
    $mensaje = "existe usuario";
}
catch (Exception $e)
{
    echo "<script>alert('adentro exception: ".$e->getMessage()."');</script>";
    $ok = 0;
    $mensaje = $e -> getMessage();
}

header('location: /modificacionUsuario.php?ok='.$ok.'&mensaje='.$mensaje);
?>