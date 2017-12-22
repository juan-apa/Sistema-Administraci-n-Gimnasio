<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/1/17
 * Time: 7:37 PM
 */

include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__) . '/logica/objetos/Usuario.php');
include_once(dirname(__FILE__) . '/logica/objetos/Rol.php');
include_once(dirname(__FILE__).'/grafica/Controladora.php');
session_start();
$con = new Controladora();
$permiso = $con->getRol();
$cantidades = array();
try{
    $cantidades = $con -> getF() -> cantidades();
} catch (Exception $e) {
    echo "<script>alert('Error al obtener las cantidades de usuarios de la base de datos.');</script>";
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
            <li class="breadcrumb-item active">Usuarios</li>
        </ol>
        <!-- Example DataTables Card-->
        <h1>Listado de Usuarios</h1>

        <?php  if($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-inverse">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Fecha Nacimiento</th>
                        <th>Soc. Médica</th>
                        <th>Emer. Móvil</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Modificar</th>
                        <th>Pago Atrasado</th>
                    </tr>
                    </thead>
                    <tfoot class="thead-inverse">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Fecha Nacimiento</th>
                        <th>Soc. Médica</th>
                        <th>Emer. Móvil</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Modificar</th>
                        <th>Pago Atrasado</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php include(dirname(__FILE__) . '/grafica/ControladoraListadoUsuarios.php'); ?>

                    </tbody>
                </table>
            </div>
        </div>
        <h4>Usuarios: <?php echo $cantidades[2]?></h4>
        <h4>WebMasters: <?php echo $cantidades[1]?></h4>
        <h4>Administradores: <?php echo $cantidades[0]?></h4>
        <?php else: ?>
            <h2 class="text-danger">Permisos insuficientes.</h2>
        <?php endif; ?>
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
