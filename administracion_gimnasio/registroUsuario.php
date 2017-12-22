<?php
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__) . '/logica/Fachada.php');
include_once(dirname(__FILE__) . '/logica/objetos/Usuario.php');
include_once(dirname(__FILE__) . '/logica/objetos/Rol.php');
include_once(dirname(__FILE__) . '/grafica/Controladora.php');

session_start();
$con = new Controladora();
$permiso = $con->getRol();
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
          <a href="index.php">Usuarios</a>
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
          <h1>Registro de usuario</h1>

            <?php  if($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
            <form action="/grafica/ControladoraRegistroUsuario.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula</label>
                    <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Cédula">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                </div>
                <div class="form-group">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control inputFecha" id="fechaNacimiento" name="fechaNacimiento" data-date-format="mm/dd/yyyy">
                </div>
                <div class="form-group">
                    <label for="socMedica">Sociedad Médica</label>
                    <input type="text" class="form-control" id="socMedica" name="socMedica" placeholder="Sociedad médica">
                </div>
                <div class="form-group">
                    <label for="emerMovil">Emergencia Móvil</label>
                    <input type="text" class="form-control" id="emerMovil" name="emerMovil" placeholder="Emergencia Móvil">
                </div>
                <div class="form-group">
                    <label for="antecedentes">Antecedentes</label>
                    <textarea class="form-control" id="antecedentes" name="antecedentes" placeholder="Antecedentes" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="rol">Tipo de usuario</label>
                    <select class="form-control" id="rol" name="rol">
                        <option value="2">Usuario</option>
                        <option value="1">WebMaster</option>
                        <option value="0">Administrador</option>
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
