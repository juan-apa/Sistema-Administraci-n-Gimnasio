<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 11:44 PM
 */

include_once(dirname(__FILE__).'/../../persistencia/daos/DAOEjercicios.php');

class Rutina
{
    private $ejercicios;
    private $fechaInicio;
    private $idRutina;

    /**
     * Rutina constructor.
     * @param DAOEjercicios $ejercicios
     * @param string $fechaInicio
     * @param integer $idRutina
     */
    public function __construct($ejercicios, $fechaInicio, $idRutina)
    {
        $this->ejercicios = $ejercicios;
        $this->fechaInicio = $fechaInicio;
        $this->idRutina = $idRutina;
    }

    /**
     * @return DAOEjercicios
     */
    public function getEjercicios(): DAOEjercicios
    {
        return $this->ejercicios;
    }

    /**
     * @param DAOEjercicios $ejercicios
     */
    public function setEjercicios(DAOEjercicios $ejercicios)
    {
        $this->ejercicios = $ejercicios;
    }

    /**
     * @return string
     */
    public function getFechaInicio(): string
    {
        return $this->fechaInicio;
    }

    /**
     * @param string $fechaInicio
     */
    public function setFechaInicio(string $fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * @return integer
     */
    public function getIdRutina(): int
    {
        return $this->idRutina;
    }

    /**
     * @param integer $idRutina
     */
    public function setIdRutina(int $idRutina)
    {
        $this->idRutina = $idRutina;
    }

}