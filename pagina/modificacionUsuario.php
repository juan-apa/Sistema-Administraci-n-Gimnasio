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
$ok = 0;

if(isset($_GET['ok'])){
    $ok = $_GET['ok'];
    $mensaje = $_GET['mensaje'];
    echo "<script>alert('".$mensaje."')</script>";
}
if(isset($_SESSION['usuarioViejo'])){
    $usuario = $_SESSION['usuarioViejo'];
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
                <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Blank Page</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <h1>Modificación de usuario</h1>

                <?php if ($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
                <form action="/grafica/ControladoraCargarUsuario.php" method="POST">
                    <div class="form-group">
                        <label for="cedVieja">Cedula usuario a modificar</label>
                        <input type="number" class="form-control" id="cedVieja" name="cedVieja"
                               placeholder="Ingrese la cédula">
                    </div>
                    <button type="submit" class="btn btn-primary">Cargar formulario</button>
                </form>
                <?php if($ok): ?>
                <form action="/grafica/ControladoraModUsuario.php" method="POST">
                    <input type="number" class="form-control"  style="display: none" id="cedVieja" name="cedVieja"
                           placeholder="Cédula" value=<?php echo $usuario -> getCedula(); ?>>


                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                               placeholder="Ingrese el nombre" value=<?php echo $usuario -> getNombre(); ?>>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido"
                               placeholder="Apellido" value=<?php echo $usuario -> getApellido(); ?>>
                    </div>
                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="number" class="form-control" id="cedula" name="cedula"
                               placeholder="Cédula" value=<?php echo $usuario -> getCedula(); ?>>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion"
                               placeholder="Dirección" value=<?php echo $usuario -> getDireccion(); ?>>
                    </div>
                    <div class="form-group">
                        <label for="fechaNacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control inputFecha" id="fechaNacimiento" name="fechaNacimiento"
                               data-date-format="mm/dd/yyyy" value=<?php echo $usuario -> getFechaNacimiento(); ?>>
                    </div>
                    <div class="form-group">
                        <label for="socMedica">Sociedad Médica</label>
                        <input type="text" class="form-control" id="socMedica" name="socMedica"
                               placeholder="Sociedad médica" value=<?php echo $usuario -> getSocMedica(); ?>>
                    </div>
                    <div class="form-group">
                        <label for="emerMovil">Emergencia Móvil</label>
                        <input type="text" class="form-control" id="emerMovil" name="emerMovil"
                               placeholder="Emergencia Móvil" value=<?php echo $usuario -> getEmerMovil(); ?>>
                    </div>
                    <div class="form-group">
                        <label for="antecedentes">Antecedentes</label>
                        <textarea class="form-control" id="antecedentes" name="antecedentes" placeholder="Antecedentes"
                                  rows="3"><?php echo $usuario -> getAntecedentes();?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones"
                                  placeholder="Observaciones" rows="3" ><?php echo $usuario -> getObservaciones();?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="rol">Tipo de usuario</label>
                        <select class="form-control" id="rol" name="rol">
                            <option value="2" <?php if(Rol::USUARIO == $usuario->getIdRol()){echo "selected";} ?>>Usuario</option>
                            <option value="1" <?php if(Rol::WEBMASTER == $usuario->getIdRol()){echo "selected";} ?>>WebMaster</option>
                            <option value="0" <?php if(Rol::ADMINISTRADOR == $usuario->getIdRol()){echo "selected";} ?>>Administrador</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </form>
                <?php  endif; ?>
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
