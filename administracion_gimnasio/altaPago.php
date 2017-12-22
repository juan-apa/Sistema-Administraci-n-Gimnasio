<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/21/17
 * Time: 10:30 AM
 */

include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPago.php');
include_once(dirname(__FILE__) . '/logica/Fachada.php');
include_once(dirname(__FILE__) . '/logica/objetos/Usuario.php');
include_once(dirname(__FILE__) . '/logica/objetos/Rol.php');
include_once(dirname(__FILE__) . '/grafica/Controladora.php');
session_start();
$con = new Controladora();
$permiso = $con->getRol();
$ok = 0;
$cedPasada = $_GET['cedPasada'];
$idPagoPasada = $_GET['idPagoPasada'];

if(isset($_GET['ok'])){
    $ok = $_GET['ok'];
    $mensaje = $_GET['mensaje'];
    echo "<script>alert('".$mensaje."')</script>";
}


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
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include('navbar.php'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Pagos</a>
            </li>
            <li class="breadcrumb-item active">Alta Pago</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <h1>Alta de Pago</h1>

                <?php if ($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
                    <form action="/grafica/ControladoraAltaPago.php" method="POST">
                        <div class="form-group">
                            <label for="cedula">Cedula del usuario</label>
                            <input type="number" class="form-control" id="cedula" name="cedula"
                                   placeholder="Ingrese la cédula" <?php if(isset($cedPasada)){echo "value='". $cedPasada."'";} ?>>
                        </div>
                        <div class="form-group">
                            <label for="idPago">ID del Pago</label>
                            <input type="number" class="form-control" id="idPago" name="idPago"
                                   placeholder="Ingrese la cédula" <?php if(isset($idPagoPasada)){echo "value='". $idPagoPasada."'";} ?>>
                        </div>
                        <button type="submit" class="btn btn-primary">Dar de Alta</button>
                    </form>
                <?php else: ?>
                    <h2 class="text-danger">Permisos insuficientes.</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('footer.php'); ?>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.js"></script>
    <script src="js/scripts.js"></script>
</div>
</body>

</html>