<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/3/17
 * Time: 11:39 AM
 */


include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');
include_once(dirname(__FILE__).'/../logica/objetos/Rol.php');


try{
    $f = new Fachada();
    $listado = $f -> listadoUsuarios();

    for($i = 0; $i < sizeof($listado); $i++)
    {
        if($listado[$i] -> getValido())
        {
            echo "<tr class='table-info'>";
        }
        else
        {
            echo "<tr class='table-warning'>";
        }
        echo "<td>".$listado[$i] -> getNombre()."</td>";
        echo "<td>".$listado[$i] -> getApellido()."</td>";
        echo "<td>".$listado[$i] -> getCedula()."</td>";
        echo "<td>".$listado[$i] -> getFechaNacimiento()."</td>";
        echo "<td>".$listado[$i] -> getSocMedica()."</td>";
        echo "<td>".$listado[$i] -> getEmerMovil()."</td>";
        echo "<td>".Rol::obtenerRolDeIdRol($listado[$i] -> getIdRol())."</td>";
        if($listado[$i] -> getValido())
        {
            echo "<td> <a href='../bajaUsuario.php?cedPasada=".$listado[$i] -> getCedula()."'>Activo</a> </td>";
        }
        else
        {
            echo "<td> <a href='../altaUsuario.php?cedPasada=".$listado[$i] -> getCedula()."'>Inactivo</a> </td>";
        }
        echo "<td style='text-align: center'> <a href='../modificacionUsuario.php?cedPasada=".$listado[$i] -> getCedula()."' class='btn btn-warning' role='button'><i class='fa fa-fw fa-pencil'></i></a> </td>";
        echo "</tr>";
    }
} catch (Exception $e) {
    echo "<script>alert('Error: ".$e -> getMessage()."');</script>";
}