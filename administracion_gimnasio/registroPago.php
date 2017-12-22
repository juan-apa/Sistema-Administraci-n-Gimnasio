<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/6/17
 * Time: 9:22 AM
 */

include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__) . '/logica/Fachada.php');
include_once(dirname(__FILE__) . '/logica/objetos/Usuario.php');
include_once(dirname(__FILE__) . '/logica/objetos/Rol.php');
include_once(dirname(__FILE__) . '/grafica/Controladora.php');
include_once(dirname(__FILE__) . '/grafica/ControladoraRegistroPago.php');

session_start();
//echo "<script>alert('Antes Controladora');</script>";
$con = new Controladora();
//echo "<script>alert('Despues Controladora');</script>";
$conRegistro = new ControladoraRegistroPago();
//echo "<script>alert('Despues ControladoraPago');</script>";
$permiso = $con->getRol();

$fechaPagoPasado = $_GET['fechaPago'];
$tipoPagoPasado = $_GET['tipoPago'];
$montoPasado = $_GET['monto'];
$cedulaUsuarioPasado = $_GET['cedulaUsuario'];
if(isset($fechaPagoPasado, $tipoPagoPasado, $montoPasado, $cedulaUsuarioPasado))
{

    try{
        echo "<script>alert('".$cedulaUsuarioPasado."')</script>";
        $conRegistro -> registroPago($fechaPagoPasado, (int) $tipoPagoPasado, (int) $montoPasado, (int) $cedulaUsuarioPasado);
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
                <a href="index.php">Pagos</a>
            </li>
            <li class="breadcrumb-item active">Registro</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <?php
                $ok = $_GET['ok'];
                if(isset($ok)){
                    $mensaje = $_GET['mensaje'];
                    echo "<script>alert('".$mensaje."')</script>";
                }
                ?>
                <h1>Registro de Pago</h1>

                <?php  if($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
                    <form action="/registroPago.php" method="GET">
                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="number" class="form-control" id="cedulaUsuario" name="cedulaUsuario" placeholder="Cédula">
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de pago</label>
                            <input type="date" class="form-control inputFecha" id="fechaPago" name="fechaPago" data-date-format="mm/dd/yyyy">
                        </div>
                        <div class="form-group">
                            <label for="cedula">Monto</label>
                            <input type="number" class="form-control" id="monto" name="monto" placeholder="Monto">
                        </div>
                        <div class="form-group">
                            <label for="rol">Tipo de Pago</label>
                            <select class="form-control" id="tipoPago" name="tipoPago">
                                <?php
                                    $conRegistro -> listadoTiposPagos();
                                ?>
                            </select>
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
