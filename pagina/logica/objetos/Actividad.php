<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/21/17
 * Time: 7:02 PM
 */

class Actividad
{
    private $idActividad;
    private $comienzo;
    private $duracion;
    private $nombre;
    private $profesor;
    private $valido;
    private $lunes;
    private $martes;
    private $miercoles;
    private $jueves;
    private $viernes;


    /**
     * Actividad constructor.
     * @param int $idActividad
     * @param string $comienzo
     * @param int $duracion
     * @param string $nombre
     * @param string $profesor
     * @param int $valido
     * @param int $lunes
     * @param int $martes
     * @param int $miercoles
     * @param int $jueves
     * @param int $viernes
     */
    public function __construct(int $idActividad, string $comienzo, int $duracion, string $nombre, string $profesor, int $valido, int $lunes, int $martes, int $miercoles, int $jueves, int $viernes)
    {
        $this->idActividad = $idActividad;
        $this->comienzo = $comienzo;
        $this->duracion = $duracion;
        $this->nombre = $nombre;
        $this->profesor = $profesor;
        $this->valido = $valido;
        $this -> lunes = $lunes;
        $this -> martes = $martes;
        $this -> miercoles = $miercoles;
        $this -> jueves = $jueves;
        $this -> viernes = $viernes;
    }

    /**
     * @return int
     */
    public function getIdActividad(): int
    {
        return $this->idActividad;
    }

    /**
     * @param int $idActividad
     */
    public function setIdActividad(int $idActividad): void
    {
        $this->idActividad = $idActividad;
    }

    /**
     * @return string
     */
    public function getComienzo(): string
    {
        return $this->comienzo;
    }

    /**
     * @param string $comienzo
     */
    public function setComienzo(string $comienzo): void
    {
        $this->comienzo = $comienzo;
    }

    /**
     * @return int
     */
    public function getDuracion(): int
    {
        return $this->duracion;
    }

    /**
     * @param int $duracion
     */
    public function setDuracion(int $duracion): void
    {
        $this->duracion = $duracion;
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
    public function getProfesor(): string
    {
        return $this->profesor;
    }

    /**
     * @param string $profesor
     */
    public function setProfesor(string $profesor): void
    {
        $this->profesor = $profesor;
    }

    /**
     * @return mixed
     */
    public function getValido()
    {
        return $this->valido;
    }

    /**
     * @param mixed $valido
     */
    public function setValido($valido): void
    {
        $this->valido = $valido;
    }

    /**
     * @return int
     */
    public function getLunes(): int
    {
        return $this->lunes;
    }

    /**
     * @param int $lunes
     */
    public function setLunes(int $lunes): void
    {
        $this->lunes = $lunes;
    }

    /**
     * @return int
     */
    public function getMartes(): int
    {
        return $this->martes;
    }

    /**
     * @param int $martes
     */
    public function setMartes(int $martes): void
    {
        $this->martes = $martes;
    }

    /**
     * @return int
     */
    public function getMiercoles(): int
    {
        return $this->miercoles;
    }

    /**
     * @param int $miercoles
     */
    public function setMiercoles(int $miercoles): void
    {
        $this->miercoles = $miercoles;
    }

    /**
     * @return int
     */
    public function getJueves(): int
    {
        return $this->jueves;
    }

    /**
     * @param int $jueves
     */
    public function setJueves(int $jueves): void
    {
        $this->jueves = $jueves;
    }

    /**
     * @return int
     */
    public function getViernes(): int
    {
        return $this->viernes;
    }

    /**
     * @param int $viernes
     */
    public function setViernes(int $viernes): void
    {
        $this->viernes = $viernes;
    }

    public function diasActividad() : array
    {
        $ret = array();
        if($this -> lunes == 1)
            array_push($ret, 'lunes');

        if($this -> martes == 1)
            array_push($ret, 'martes');

        if($this -> miercoles == 1)
            array_push($ret, 'miercoles');

        if($this -> jueves == 1)
            array_push($ret, 'jueves');

        if($this -> viernes == 1)
            array_push($ret, 'viernes');

        return $ret;
    }

}