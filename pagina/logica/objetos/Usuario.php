<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 5:46 PM
 */

include_once(dirname(__FILE__).'/../../persistencia/daos/DAORutinas.php');

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

    /**
     * Usuario constructor.
     * @param $idUsuario
     * @param $nombre
     * @param $apellido
     * @param $cedula
     * @param $direccion
     * @param $fechaNacimiento
     * @param $socMedica
     * @param $emerMovil
     * @param $antecedentes
     * @param $observaciones
     * @param $valido
     * @param $idRol
     * @param $telefonos
     * @param $rutinas
     * @param $pagos
     */
    public function __construct($idUsuario, $nombre, $apellido, $cedula, $direccion, $fechaNacimiento, $socMedica,
                                $emerMovil, $antecedentes, $observaciones, $valido, $idRol, $telefonos, $rutinas, $pagos)
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
        $this->telefonos = $telefonos;
        $this->rutinas = $rutinas;
        $this->pagos = $pagos;
    }

    /**
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param integer $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return integer
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @param integer $cedula
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param string $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return string
     */
    public function getSocMedica()
    {
        return $this->socMedica;
    }

    /**
     * @param string $socMedica
     */
    public function setSocMedica($socMedica)
    {
        $this->socMedica = $socMedica;
    }

    /**
     * @return string
     */
    public function getEmerMovil()
    {
        return $this->emerMovil;
    }

    /**
     * @param string $emerMovil
     */
    public function setEmerMovil($emerMovil)
    {
        $this->emerMovil = $emerMovil;
    }

    /**
     * @return string
     */
    public function getAntecedentes()
    {
        return $this->antecedentes;
    }

    /**
     * @param string $antecedentes
     */
    public function setAntecedentes($antecedentes)
    {
        $this->antecedentes = $antecedentes;
    }

    /**
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param string $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    /**
     * @return integer
     */
    public function getValido()
    {
        return $this->valido;
    }

    /**
     * @param integer $valido
     */
    public function setValido($valido)
    {
        $this->valido = $valido;
    }

    /**
     * @return integer
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * @param integer $idRol
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }

    /**
     * @return DAOTelefonos
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * @param DAOTelefonos $telefonos
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;
    }

    /**
     * @return DAORutinas
     */
    public function getRutinas()
    {
        return $this->rutinas;
    }

    /**
     * @param DAORutinas $rutinas
     */
    public function setRutinas($rutinas)
    {
        $this->rutinas = $rutinas;
    }

    /**
     * @return DAOPagos
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * @param DAOPagos $pagos
     */
    public function setPagos($pagos)
    {
        $this->pagos = $pagos;
    }



}