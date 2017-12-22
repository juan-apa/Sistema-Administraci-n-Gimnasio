<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/22/17
 * Time: 9:24 AM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOPagina.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
echo "<script>alert('UNO');</script>";
$titulo = $_POST['titulo'];
$c1Titulo = $_POST['c1Titulo'];
$c1Texto = $_POST['c1Texto'];
$c2Titulo = $_POST['c2Titulo'];
$c2Texto = $_POST['c2Texto'];
$c3Titulo = $_POST['c3Titulo'];
$c3Texto = $_POST['c3Texto'];
$titulo2 = $_POST['titulo2'];
$c4Titulo = $_POST['c4Titulo'];
$c4Texto = $_POST['c4Texto'];
$c5Titulo = $_POST['c5Titulo'];
$c5Texto = $_POST['c5Texto'];
$c6Titulo = $_POST['c6Titulo'];
$c6Texto = $_POST['c6Texto'];
$fTitulo = $_POST['fTitulo'];
$fTexto = $_POST['fTexto'];
$r = array(0=>'',1=>'',2=>'',3=>'',4=>'',5=>'');
echo "<script>alert('DOS');</script>";

$directorio_destino = 'images';


for($i = 1; $i < 7; $i++)
{
    echo "<script>alert('TRES');</script>";
    $nombre_fichero = 'c'.$i.'i';
    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];

    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name)){

        $img_file = $_FILES[$nombre_fichero]['name'];
        $img_type = $_FILES[$nombre_fichero]['type'];

        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type, "jpg")) || strpos($img_type, "png"))){
            if (move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file)){
                $r[$i-1] = $directorio_destino . '/' . $img_file;
            }
        }
    }
}

try{
    echo "<script>alert('CUATRO');</script>";
    $con -> getF() -> modificarPagina($titulo, $c1Titulo, $c1Texto, $c2Titulo, $c2Texto, $c3Titulo, $c3Texto, $titulo2,
        $c4Titulo, $c4Texto, $c5Titulo, $c5Texto, $c6Titulo, $c6Texto, $fTitulo, $fTexto,
        (string) $r[0], (string) $r[1], (string) $r[2], (string) $r[3], (string) $r[4], (string) $r[5]);
    echo "<script>alert('CINCO');</script>";
    header('location: ../edicionPagina.php?ok=1&mensaje=Modificacion exitosa');
} catch (Exception $e)
{
    header('location: ../edicionPagina.php?ok=0&mensaje='.$e -> getMessage());
}
