<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/6/17
 * Time: 7:18 PM
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
$conReg = new ControladoraRegistroPago();
$permiso = $con->getRol();
$ok = 0;
$cedPasada;
$idPagoPasado = 0;
$pagoViejo;

if(isset($_GET['ok'])){
    $ok = $_GET['ok'];
    $mensaje = $_GET['mensaje'];
}
if(isset($_GET['cedPasada'], $_GET['idPago'])){
    $cedPasada = $_GET['cedPasada'];
    $idPagoPasado = $_GET['idPago'];
    try{
        $pagoViejo = $con -> getF() -> kesimoPagoDeUsuario($cedPasada, $idPagoPasado);
        $_SESSION['pagoViejo'] = $pagoViejo;
    } catch (Exception $e) {
        echo "<script>alert('Error al obtener datos de la base de datos');</script>";
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
                <h1>Modificación de Pago</h1>
                <form action="/modificacionPago.php" method="get">
                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="number" class="form-control" id="cedPasada" name="cedPasada" placeholder="Cédula" <?php if(isset($cedPasada)){echo "value=".$cedPasada;} ?>>
                    </div>
                    <div class="form-group">
                        <label for="cedula">ID del Pago</label>
                        <input type="number" class="form-control" id="idPago" name="idPago" placeholder="ID del pago" <?php if(isset($idPagoPasado)){echo "value=".$idPagoPasado;} ?>>
                    </div>
                    <button type="submit" class="btn btn-primary">Cargar formulario</button>
                </form>

                <?php  if($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
                    <?php if (isset($pagoViejo)):?>
                        <form action="/grafica/ControladoraModPago.php" method="POST">
                            <div class="form-group" style="display: none;">
                                <label for="cedula">Cédula</label>
                                <input type="number" class="form-control" id="cedulaUsuario" name="cedulaUsuario" placeholder="Cédula" <?php echo "value=".$cedPasada; ?>>
                            </div>
                            <div class="form-group">
                                <label for="fechaNacimiento">Fecha de pago</label>
                                <input type="date" class="form-control inputFecha" id="fechaPago" name="fechaPago" data-date-format="mm/dd/yyyy" <?php echo " value=".$pagoViejo -> getFechaPago(); ?>>
                            </div>
                            <div class="form-group">
                                <label for="cedula">Monto</label>
                                <input type="number" class="form-control" id="monto" name="monto" placeholder="Monto" <?php echo "value=".$pagoViejo -> getMonto(); ?>>
                            </div>
                            <div class="form-group">
                                <label for="rol">Tipo de Pago</label>
                                <select class="form-control" id="tipoPago" name="tipoPago">
                                    <?php
                                    $listado = $con -> getF() -> listadoTipoPagos();
                                    for($i = 0; $i < sizeof($listado); $i++)
                                    {
                                        if($pagoViejo -> getTipoPago() == $listado[$i] -> getTipoPago())
                                        {
                                            echo "<option selected value='".$listado[$i] -> getTipoPago()."'>".$listado[$i] -> getDescripcion()."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$listado[$i] -> getTipoPago()."'>".$listado[$i] -> getDescripcion()."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="display: none">
                                <label for="cedula">idPago</label>
                                <input type="number" class="form-control" id="idPago" name="idPago" placeholder="idPago" <?php echo "value=".$idPagoPasado; ?>>
                            </div>
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </form>
                    <?php endif; ?>
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
