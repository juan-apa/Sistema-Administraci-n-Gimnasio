<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/4/17
 * Time: 10:24 AM
 */

include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__) . '/logica/objetos/Usuario.php');
include_once(dirname(__FILE__) . '/persistencia/daos/DAOPagos.php');
include_once(dirname(__FILE__) . '/logica/objetos/Rol.php');
include_once(dirname(__FILE__).'/grafica/Controladora.php');
include_once(dirname(__FILE__) . '/grafica/ControladoraListadoPagos.php');
session_start();
$con = new Controladora();
$permiso = $con->getRol();
$cedPasada = $_GET['cedPasada'];
$facAnio = 0;
try{
    $hoyA = date('Y');
    $hoyM = date('m');
    $facAnio = $con -> getF() -> facturacionAnio((int) $hoyA);
    $facMes = $con -> getF() -> facturacionMes((int) $hoyM);
} catch (Exception $e) {
    echo "<script>alert('Error al obtener el total de facturación por mes/año');</script>";
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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(dirname(__FILE__) . '/navbar.php'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Listados</a>
            </li>
            <li class="breadcrumb-item active">Pagos</li>
        </ol>
        <!-- Example DataTables Card-->
        <h1>Listado de Pagos</h1>
        <?php  if($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
            <form action="/listadoPagos.php" method="GET">
                <div class="form-group">
                    <label for="cedVieja">Cedula usuario</label>
                    <input type="number" class="form-control" id="cedPasada" name="cedPasada"
                           placeholder="Ingrese la cédula" <?php if(isset($cedPasada)){echo "value='".$cedPasada."'";}?>>
                </div>
                <button type="submit" class="btn btn-primary">Cargar tabla</button>
            </form>
        <?php endif; ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-inverse">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Duracion</th>
                            <th>Estado</th>
                            <th>Modificación</th>
                        </tr>
                        </thead>
                        <tfoot class="thead-inverse">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Duracion</th>
                            <th>Estado</th>
                            <th>Modificación</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        <?php
                            if(isset($cedPasada)){
                                $controladoraPagos = new ControladoraListadoPagos();
                                $controladoraPagos -> listarPagos($cedPasada);
                            }
                        ?>

                        </tbody>
                    </table>
                </div>
                <?php if($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
                <h4>Facturación por mes: <?php echo $facMes; ?></h4>
                <h4>Facturación por anio: <?php echo $facAnio; ?></h4>
                <?php endif;?>
            </div>
<!--        --><?php //else: ?>
<!--            <h2 class="text-danger">Permisos insuficientes.</h2>-->
<!--        --><?php //endif; ?>
    </div>
    <!-- /.container-fluid-->
    <?php include(dirname(__FILE__) . '/footer.php'); ?>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
</div>
</body>

</html>

