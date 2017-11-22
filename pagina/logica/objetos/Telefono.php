<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/22/17
 * Time: 10:55 AM
 */

class Telefono
{
    private $numeroTelefono;

    /**
     * Telefono constructor.
     * @param int $numeroTelefono
     */
    public function __construct(int $numeroTelefono)
    {
        $this -> numeroTelefono = $numeroTelefono;
    }

    /**
     * @return integer
     */
    public function getNumeroTelefono()
    {
        return $this->numeroTelefono;
    }

    /**
     * @param integer $numeroTelefono
     */
    public function setNumeroTelefono(int $numeroTelefono)
    {
        $this->numeroTelefono = $numeroTelefono;
    }
}