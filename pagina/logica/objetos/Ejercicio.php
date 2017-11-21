<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 11:51 PM
 */

class Ejercicio
{
    private $idEjercicio;
    private $nombre;
    private $repeticiones;
    private $series;

    /**
     * Ejercicio constructor.
     * @param integer $idEjercicio
     * @param string $nombre
     * @param integer $repeticiones
     * @param integer $series
     */
    public function __construct($idEjercicio, $nombre, $repeticiones, $series)
    {
        $this->idEjercicio = $idEjercicio;
        $this->nombre = $nombre;
        $this->repeticiones = $repeticiones;
        $this->series = $series;
    }

    /**
     * @return integer
     */
    public function getIdEjercicio()
    {
        return $this->idEjercicio;
    }

    /**
     * @param integer $idEjercicio
     */
    public function setIdEjercicio($idEjercicio)
    {
        $this->idEjercicio = $idEjercicio;
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
     * @return integer
     */
    public function getRepeticiones()
    {
        return $this->repeticiones;
    }

    /**
     * @param integer $repeticiones
     */
    public function setRepeticiones($repeticiones)
    {
        $this->repeticiones = $repeticiones;
    }

    /**
     * @return integer
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param integer $series
     */
    public function setSeries($series)
    {
        $this->series = $series;
    }


}