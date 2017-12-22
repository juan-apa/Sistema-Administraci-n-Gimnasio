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
    private $valido;
    private $idPago;
    private $idUsuario;
    private $monto;
    private $descripcion;
    private $duracion;

    /**
     * Pago constructor.
     * @param string $fechaPago
     * @param int $tipoPago
     * @param int $valido
     * @param int $idPago
     */
    public function __construct(string $fechaPago, int $tipoPago, int $valido, int $monto, int $idPago, int $idUsuario, string $descripcion, int $duracion)
    {
        $this->fechaPago = $fechaPago;
        $this->tipoPago = $tipoPago;
        $this->valido = $valido;
        $this->idPago = $idPago;
        $this -> idUsuario = $idUsuario;
        $this -> monto = $monto;
        $this -> descripcion = $descripcion;
        $this -> duracion = $duracion;
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
    public function getValido(): int
    {
        return $this->valido;
    }

    /**
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    /**
     * @param int $cedulaUsuario
     */
    public function setIdUsuario(int $idUsuario)
    {
        $this->idUsuario = $idUsuario;
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

    /**
     * @return int
     */
    public function getMonto(): int
    {
        return $this->monto;
    }

    /**
     * @param int $monto
     */
    public function setMonto(int $monto)
    {
        $this->monto = $monto;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion)
    {
        $this->descripcion = $descripcion;
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

    public function atrasado() : int
    {
        $ret = 0;
        if(date('Y-m-d') > date('Y-m-d', strtotime($this -> fechaPago.' + '.$this -> getDuracion().' days')))
            $ret = 1;
        return $ret;
    }

}