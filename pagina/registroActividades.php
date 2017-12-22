<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/22/17
 * Time: 6:40 AM
 */

include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__) . '/logica/Fachada.php');
include_once(dirname(__FILE__) . '/logica/objetos/Usuario.php');
include_once(dirname(__FILE__) . '/logica/objetos/Rol.php');
include_once(dirname(__FILE__) . '/grafica/Controladora.php');
include_once(dirname(__FILE__) . '/grafica/ControladoraRegistroPago.php');

session_start();
$con = new Controladora();
$permiso = $con->getRol();

$comienzo = $_GET['comienzo'];
$duracion = $_GET['duracion'];
$nombre = $_GET['nombre'];
$profesor = $_GET['profesor'];
$valido = 1;
$lunes = $_GET['lunes'];
$martes = $_GET['martes'];
$miercoles = $_GET['miercoles'];
$jueves = $_GET['jueves'];
$viernes = $_GET['viernes'];

if(isset($comienzo, $duracion, $nombre, $profesor))
{
    $a = new Actividad(0, $comienzo, (int) $duracion, $nombre, $profesor, (int) $valido, (int) $lunes, (int) $martes, (int) $miercoles, (int) $jueves, (int) $viernes);
    try{
        $con -> getF() -> registroActividad($a);
        echo "<script>alert('Actividad registrada con éxito.')</script>";
    } catch (Exception $e){
        echo "<script>alert('".$e -> getMessage()."')</script>";
    }
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
                <a href="index.php">Actividades</a>
            </li>
            <li class="breadcrumb-item active">Registro</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <h1>Registro de Actividad</h1>

                <?php  if($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
                    <form action="/registroActividades.php" method="GET">
                        <div class="form-group">
                            <label for="comienzo">Comienzo</label>
                            <input type="time" class="form-control" id="comienzo" name="comienzo" placeholder="12-00">
                        </div>
                        <div class="form-group">
                            <label for="duracion">Duración</label>
                            <input type="number" class="form-control" id="duracion" name="duracion" >
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre">
                        </div>
                        <div class="form-group">
                            <label for="profesor">Profesor</label>
                            <input type="text" class="form-control" id="profesor" name="profesor" placeholder="profesor">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="1" name="lunes">
                                lunes
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="1" name="martes">
                                martes
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="1" name="miercoles">
                                miercoles
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="1" name="jueves">
                                jueves
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="1" name="viernes">
                                viernes
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Ingresar</button>
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
