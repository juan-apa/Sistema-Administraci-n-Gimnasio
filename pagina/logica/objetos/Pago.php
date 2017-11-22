<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/22/17
 * Time: 11:06 AM
 */

class Pago
{
    private $fechaPago;
    private $tipoPago;
    private $duracion;
    private $valido;
    private $idPago;

    /**
     * Pago constructor.
     * @param string $fechaPago
     * @param int $tipoPago
     * @param int $duracion
     * @param int $valido
     * @param int $idPago
     */
    public function __construct(string $fechaPago, int $tipoPago, int $duracion, int $valido, int $idPago)
    {
        $this->fechaPago = $fechaPago;
        $this->tipoPago = $tipoPago;
        $this->duracion = $duracion;
        $this->valido = $valido;
        $this->idPago = $idPago;
    }

    /**
     * @return string
     */
    public function getFechaPago(): string
    {
        return $this->fechaPago;
    }

    /**
     * @param string $fechaPago
     */
    public function setFechaPago(string $fechaPago)
    {
        $this->fechaPago = $fechaPago;
    }

    /**
     * @return int
     */
    public function getTipoPago(): int
    {
        return $this->tipoPago;
    }

    /**
     * @param int $tipoPago
     */
    public function setTipoPago(int $tipoPago)
    {
        $this->tipoPago = $tipoPago;
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
    public function setDuracion(int $duracion)
    {
        $this->duracion = $duracion;
    }

    /**
     * @return int
     */
    public function getValido(): int
    {
        return $this->valido;
    }

    /**
     * @param int $valido
     */
    public function setValido(int $valido)
    {
        $this->valido = $valido;
    }

    /**
     * @return int
     */
    public function getIdPago(): int
    {
        return $this->idPago;
    }

    /**
     * @param int $idPago
     */
    public function setIdPago(int $idPago)
    {
        $this->idPago = $idPago;
    }




}