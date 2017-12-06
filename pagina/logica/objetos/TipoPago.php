<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/6/17
 * Time: 9:36 AM
 */

class TipoPago
{
    private $tipoPago;
    private $descripcion;
    private $duracion;

    public function __construct(int $tipoPago, string $descripcion, int $duracion)
    {
        $this -> tipoPago = $tipoPago;
        $this -> descripcion = $descripcion;
        $this -> duracion = $duracion;
    }

    /**
     * @return int
     */
    public function getTipoPago(): int
    {
        return $this->tipoPago;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @return int
     */
    public function getDuracion(): int
    {
        return $this->duracion;
    }


}