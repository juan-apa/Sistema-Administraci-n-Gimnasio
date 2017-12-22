<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/22/17
 * Time: 8:54 AM
 */

include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/logica/Fachada.php');
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
                <a href="index.php">Pagina</a>
            </li>
            <li class="breadcrumb-item active">Modificación</li>
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
                <h1>Modificación de página</h1>

                <?php  if($permiso == Rol::obtenerRolDeIdRol(Rol::WEBMASTER)): ?>
                    <form action="/grafica/ControladoraModPagina.php" method="POST">
                        <div class="form-group">
                            <label for="nombre">Titulo</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Viejas Inc">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Cuadrado 1, Titulo</label>
                            <input type="text" class="form-control" id="c1Titulo" name="c1Titulo" placeholder="c1Titulo">
                        </div>
                        <div class="form-group">
                            <label for="antecedentes">Cuadrado 1, Texto</label>
                            <textarea class="form-control" id="c1Texto" name="c1Texto" placeholder="c1Texto" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Cuadrado 2, Titulo</label>
                            <input type="text" class="form-control" id="c2Titulo" name="c2Titulo" placeholder="c2Titulo">
                        </div>
                        <div class="form-group">
                            <label for="antecedentes">Cuadrado 2, Texto</label>
                            <textarea class="form-control" id="c2Texto" name="c2Texto" placeholder="c2Texto" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Cuadrado 3, Titulo</label>
                            <input type="text" class="form-control" id="c1Titulo" name="c1Titulo" placeholder="c1Titulo">
                        </div>
                        <div class="form-group">
                            <label for="antecedentes">Cuadrado 3, Texto</label>
                            <textarea class="form-control" id="c3Texto" name="c3Texto" placeholder="c3Texto" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Seccion 2, Titulo</label>
                            <input type="text" class="form-control" id="titulo2" name="titulo2" placeholder="titulo2">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Cuadrado 4, Titulo</label>
                            <input type="text" class="form-control" id="c4Titulo" name="c4Titulo" placeholder="c4Titulo">
                        </div>
                        <div class="form-group">
                            <label for="antecedentes">Cuadrado 4, Texto</label>
                            <textarea class="form-control" id="c4Texto" name="c4Texto" placeholder="c4Texto" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Cuadrado 5, Titulo</label>
                            <input type="text" class="form-control" id="c5Titulo" name="c5Titulo" placeholder="c5Titulo">
                        </div>
                        <div class="form-group">
                            <label for="antecedentes">Cuadrado 5, Texto</label>
                            <textarea class="form-control" id="c5Texto" name="c5Texto" placeholder="c5Texto" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Cuadrado 6, Titulo</label>
                            <input type="text" class="form-control" id="c6Titulo" name="c6Titulo" placeholder="c6Titulo">
                        </div>
                        <div class="form-group">
                            <label for="antecedentes">Cuadrado 6, Texto</label>
                            <textarea class="form-control" id="c6Texto" name="c6Texto" placeholder="c6Texto" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nombre">footer, Titulo</label>
                            <input type="text" class="form-control" id="fTitulo" name="fTitulo" placeholder="fTitulo">
                        </div>
                        <div class="form-group">
                            <label for="antecedentes">footer, Texto</label>
                            <textarea class="form-control" id="fTexto" name="fTexto" placeholder="fTexto" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Cuadrado 1, Imagen</label>
                            <input class="form-control-file" name="c1i" type="file" />
                        </div>
                        <div class="form-group">
                            <label>Cuadrado 2, Imagen</label>
                            <input class="form-control-file" name="c2i" type="file" />
                        </div>
                        <div class="form-group">
                            <label>Cuadrado 3, Imagen</label>
                            <input class="form-control-file" name="c3i" type="file" />
                        </div>
                        <div class="form-group">
                            <label>Cuadrado 4, Imagen</label>
                            <input class="form-control-file" name="c4i" type="file" />
                        </div>
                        <div class="form-group">
                            <label>Cuadrado 5, Imagen</label>
                            <input class="form-control-file" name="c5i" type="file" />
                        </div>
                        <div class="form-group">
                            <label>Cuadrado 6, Imagen</label>
                            <input class="form-control-file" name="c6i" type="file" />
                        </div>



                        <button type="submit" class="btn btn-primary">Modificar</button>
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

