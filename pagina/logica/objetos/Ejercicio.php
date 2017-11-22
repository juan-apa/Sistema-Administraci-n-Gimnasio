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
    private $peso;

    /**
     * Ejercicio constructor.
     * @param integer $idEjercicio
     * @param string $nombre
     * @param integer $repeticiones
     * @param integer $series
     * @param integer $peso
     */
    public function __construct(int $idEjercicio, string $nombre, int $repeticiones, int $series, int $peso)
    {
        $this->idEjercicio = $idEjercicio;
        $this->nombre = $nombre;
        $this->repeticiones = $repeticiones;
        $this->series = $series;
        $this->peso = $peso;
    }

    /**
     * @return integer
     */
    public function getIdEjercicio(): int
    {
        return $this->idEjercicio;
    }

    /**
     * @param integer $idEjercicio
     */
    public function setIdEjercicio($idEjercicio): void
    {
        $this->idEjercicio = $idEjercicio;
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
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return integer
     */
    public function getRepeticiones(): int
    {
        return $this->repeticiones;
    }

    /**
     * @param integer $repeticiones
     */
    public function setRepeticiones($repeticiones): void
    {
        $this->repeticiones = $repeticiones;
    }

    /**
     * @return integer
     */
    public function getSeries(): int
    {
        return $this->series;
    }

    /**
     * @param integer $series
     */
    public function setSeries($series): void
    {
        $this->series = $series;
    }

    /**
     * @return int
     */
    public function getPeso(): int
    {
        return $this->peso;
    }

    /**
     * @param int $peso
     */
    public function setPeso(int $peso): void
    {
        $this->peso = $peso;
    }


}