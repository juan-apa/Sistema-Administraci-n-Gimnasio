<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 5:46 PM
 */

include_once(dirname(__FILE__).'/../../persistencia/daos/DAORutinas.php');
include_once(dirname(__FILE__).'/../../persistencia/daos/DAOPagos.php');
include_once(dirname(__FILE__).'/../../persistencia/daos/DAOTelefonos.php');
include_once(dirname(__FILE__).'/../../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../../persistencia/excepciones/ExceptionPago.php');
include_once(dirname(__FILE__).'/Rutina.php');
include_once(dirname(__FILE__).'/Telefono.php');
include_once(dirname(__FILE__).'/Ejercicio.php');
include_once(dirname(__FILE__).'/Pago.php');

class Usuario
{
    private $idUsuario;
    private $nombre;
    private $apellido;
    private $cedula;
    private $direccion;
    private $fechaNacimiento;
    private $socMedica;
    private $emerMovil;
    private $antecedentes;
    private $observaciones;
    private $valido;
    private $idRol;
    private $telefonos;
    private $rutinas;
    private $pagos;
    private $contrasenia;

    /**
     * Usuario constructor.
     * @param integer $idUsuario
     * @param string $nombre
     * @param string $apellido
     * @param integer $cedula
     * @param string $direccion
     * @param string $fechaNacimiento
     * @param string $socMedica
     * @param string $emerMovil
     * @param string $antecedentes
     * @param string $observaciones
     * @param integer $valido
     * @param integer $idRol
     * @param string $contrasenia
     */
    public function __construct(int $idUsuario, string $nombre, string $apellido, int $cedula, string $direccion,
                                string $fechaNacimiento, string $socMedica, string $emerMovil, string $antecedentes,
                                string  $observaciones, int $valido, int $idRol, string $contrasenia)
    {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->direccion = $direccion;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->socMedica = $socMedica;
        $this->emerMovil = $emerMovil;
        $this->antecedentes = $antecedentes;
        $this->observaciones = $observaciones;
        $this->valido = $valido;
        $this->idRol = $idRol;
        $this->contrasenia = $contrasenia;
        $this->rutinas = new DAORutinas($idUsuario);
        $this->telefonos = new DAOTelefonos($idUsuario);
        $this->pagos = new DAOPagos($idUsuario);
    }

    public function test()
    {
        echo sprintf("<h1>%s, %d</h1>", $this -> nombre, $this -> cedula);
    }

    /**
     * @return integer
     */
    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    /**
     * @param integer $idUsuario
     */
    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getApellido(): string
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     */
    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return integer
     */
    public function getCedula(): int
    {
        return $this->cedula;
    }

    /**
     * @param integer $cedula
     */
    public function setCedula(int $cedula): void
    {
        $this->cedula = $cedula;
    }

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getFechaNacimiento(): string
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param string $fechaNacimiento
     */
    public function setFechaNacimiento(string $fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return string
     */
    public function getSocMedica(): string
    {
        return $this->socMedica;
    }

    /**
     * @param string $socMedica
     */
    public function setSocMedica(string $socMedica): void
    {
        $this->socMedica = $socMedica;
    }

    /**
     * @return string
     */
    public function getEmerMovil(): string
    {
        return $this->emerMovil;
    }

    /**
     * @param string $emerMovil
     */
    public function setEmerMovil(string $emerMovil): void
    {
        $this->emerMovil = $emerMovil;
    }

    /**
     * @return string
     */
    public function getAntecedentes(): string
    {
        return $this->antecedentes;
    }

    /**
     * @param string $antecedentes
     */
    public function setAntecedentes(string $antecedentes): void
    {
        $this->antecedentes = $antecedentes;
    }

    /**
     * @return string
     */
    public function getObservaciones(): string
    {
        return $this->observaciones;
    }

    /**
     * @param string $observaciones
     */
    public function setObservaciones(string $observaciones): void
    {
        $this->observaciones = $observaciones;
    }

    /**
     * @return integer
     */
    public function getValido(): int
    {
        return $this->valido;
    }

    /**
     * @param integer $valido
     */
    public function setValido(int $valido): void
    {
        $this->valido = $valido;
    }

    /**
     * @return integer
     */
    public function getIdRol(): int
    {
        return $this->idRol;
    }

    /**
     * @param integer $idRol
     */
    public function setIdRol(int $idRol): void
    {
        $this->idRol = $idRol;
    }

    /**
     * @return DAOTelefonos
     */
    public function getTelefonos(): DAOTelefonos
    {
        return $this->telefonos;
    }

    /**
     * @param DAOTelefonos $telefonos
     */
    public function setTelefonos(DAOTelefonos $telefonos): void
    {
        $this->telefonos = $telefonos;
    }

    /**
     * @return DAORutinas
     */
    public function getRutinas(): DAORutinas
    {
        return $this->rutinas;
    }

    /**
     * @param DAORutinas $rutinas
     */
    public function setRutinas(DAORutinas $rutinas): void
    {
        $this->rutinas = $rutinas;
    }

    /**
     * @return DAOPagos
     */
    public function getPagos(): DAOPagos
    {
        return $this -> pagos;
    }

    /**
     * @param DAOPagos $pagos
     */
    public function setPagos(DAOPagos $pagos): void
    {
        $this->pagos = $pagos;
    }

    /**
     * @return string
     */
    public function getContrasenia(): string
    {
        return $this->contrasenia;
    }

    /**
     * @param string $contrasenia
     */
    public function setContrasenia(string $contrasenia): void
    {
        $this->contrasenia = $contrasenia;
    }

    /**
     * @param Conexion $con
     * @param Rutina $rutina
     */
    public function insertarRutina(Conexion $con, Rutina $rutina): void
    {
        $this -> rutinas -> insBack($con, $rutina);
    }

    public function insertarTelefono(Conexion $con, Telefono $telefono): void
    {
        $this -> telefonos -> insback($con, $telefono);
    }

    /**
     * @param Conexion $con
     * @param Pago $pago
     * @throws ExceptionPersistencia
     */
    public function insertarPago(Conexion $con, Pago $pago): void
    {
        echo "<script>alert('Antes insback')</script>";
        $this -> pagos -> insBack($con, $pago);
    }

    /**
     * @param Conexion $con
     * @param int $kesimo
     * @return Pago
     * @throws ExceptionPersistencia
     */
    public function kesimoPago(Conexion $con, int $kesimo) : Pago
    {
        return $this -> pagos -> k_esimo($con, $kesimo);
    }

    /**
     * @param Conexion $con
     * @param int $idPago
     * @throws ExceptionPersistencia
     */
    public function bajaPago(Conexion $con, int $idPago) : void
    {
        $this -> pagos -> delete($con, $idPago);
    }


    /**
     * @param Conexion $con
     * @param int $idPago
     * @throws ExceptionPersistencia
     */
    public function altaPago(Conexion $con, int $idPago) : void
    {
        $this -> pagos -> alta($con, $idPago);
    }

    /**
     * @param Conexion $con
     * @return int
     */
    public function largoPagos(Conexion $con) : int
    {
        return $this -> pagos -> largo($con);
    }

    /**
     * @param Conexion $con
     * @param int $idPago
     * @param string $fecNuevo
     * @param int $tipoNuevo
     * @param int $montoNuevo
     * @return void
     * @throws ExceptionPersistencia
     */
    public function modificacionPago(Conexion $con, int $idPago, string $fecNuevo, int $tipoNuevo, int $montoNuevo) : void
    {
        $this -> pagos -> modificarPago($con, $idPago, $fecNuevo, $tipoNuevo, $montoNuevo);
    }
}