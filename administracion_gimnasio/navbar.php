<?php
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__) . '/logica/Fachada.php');
include_once(dirname(__FILE__) . '/logica/objetos/Usuario.php');
include_once(dirname(__FILE__) . '/grafica/Controladora.php');
include_once(dirname(__FILE__) . '/logica/objetos/Rol.php');
session_start();
$con = new Controladora();
$permiso = $con->getRol();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Viejas Inc.</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-fw fa-home"></i>
                    <span class="nav-link-text">Home</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Clases">
                <a class="nav-link" href="listadoActividades.php">
                    <i class="fa fa-fw fa-clock-o"></i>
                    <span class="nav-link-text">Clases</span>
                </a>
            </li>
            <?php if ($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Registro clases">
                <a class="nav-link" href="registroActividades.php">
                    <i class="fa fa-fw fa-clock-o"></i>
                    <span class="nav-link-text">Registro Clases</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)) || $permiso == Rol::obtenerRolDeIdRol(Rol::USUARIO)) : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Listados">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseListados"
                       data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Listados</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseListados">
                        <?php if (($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR))): ?>
                            <li>
                                <a href="listadoUsuarios.php">Listado de usuarios</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href=<?php echo "'listadoPagos.php?cedPasada=".$con -> getUser() -> getCedula()."''"; ?> >listado de pagos</a>
                        </li>
                        <?php if(0): ?>
<!--                        Funcionalidad no implementada-->
                        <li>
                            <a href="listadoRutinas.php">Listado de rutinas</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if ($permiso == Rol::obtenerRolDeIdRol(Rol::WEBMASTER)): ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsuarios"
                       data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-wrench"></i>
                        <span class="nav-link-text">Componentes</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseUsuarios">
                        <li>
                            <a href="edicionPagina.php">Página</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if ($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages"
                       data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">Usuarios</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                        <li>
                            <a href="registroUsuario.php">Registro Usuario</a>
                        </li>
                        <li>
                            <a href="modificacionUsuario.php">Modificación Usuario</a>
                        </li>
                        <li>
                            <a href="bajaUsuario.php">Baja Usuario</a>
                        </li>
                        <li>
                            <a href="altaUsuario.php">Alta Usuario</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if ($permiso == Rol::obtenerRolDeIdRol(Rol::ADMINISTRADOR)): ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pagos">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsePagos"
                       data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-usd"></i>
                        <span class="nav-link-text">Pagos</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapsePagos">
                        <li>
                            <a href="registroPago.php">Registro Pago</a>
                        </li>
                        <li>
                            <a href="modificacionPago.php">Modificación Pago</a>
                        </li>
                        <li>
                            <a href="bajaPago.php">Baja Pago</a>
                        </li>
                        <li>
                            <a href="altaPago.php">Alta Pago</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <!--            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sobre nosotros">-->
            <!--                <a class="nav-link" href="#">-->
            <!--                    <i class="fa fa-fw fa-info-circle"></i>-->
            <!--                    <span class="nav-link-text">Sobre nosotros</span>-->
            <!--                </a>-->
            <!--            </li>-->
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            <?php if ($permiso != Rol::obtenerRolDeIdRol(Rol::PUBLICO)) : ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <i class="fa fa-fw fa-sign-in"></i>Login</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>

<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="/grafica/ControladoraLogout.php">Logout</a>
            </div>
        </div>
    </div>
</div>