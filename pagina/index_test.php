<?php
    include_once(dirname(__FILE__).'/logica/Fachada.php');
    include_once(dirname(__FILE__).'/logica/objetos/Usuario.php');
    include_once(dirname(__FILE__).'/persistencia/daos/DAOTelefonos.php');
    include_once(dirname(__FILE__).'/persistencia/daos/DAOPagos.php');
    include_once(dirname(__FILE__).'/persistencia/daos/DAORutinas.php');
    include_once(dirname(__FILE__).'/persistencia/excepciones/ExceptionPersistencia.php');
    include_once(dirname(__FILE__).'/persistencia/excepciones/ExceptionUsuario.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body>
<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/22/17
 * Time: 11:55 AM
 */

    $fac = new Fachada();
    $fac -> test();

    try{
        $us = new Usuario(0, "Juan", "apellido", 4820381,
            "21 de Setiembre 2909/801", "1996-10-18", "socMedica", "emerMovil",
            "antecedentes", "observaciones", 1, 0);
        $us -> test();
        $fac -> registroUsuario($us);
    } catch (Exception $e){
        echo "<h1>Error: ".$e -> getMessage()."</h1>";
    }
?>
</body>
</html>
