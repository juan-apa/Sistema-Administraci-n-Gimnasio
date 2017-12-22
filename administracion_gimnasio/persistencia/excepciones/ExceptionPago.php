<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/4/17
 * Time: 11:21 AM
 */

class ExceptionPago extends Exception
{
    public const PAGO_DE_BAJA = 0;
    public const PAGO_DE_ALTA = 1;
    public const NO_EXISTE_PAGO = 2;
    public const EXISTE_PAGO = 3;

    private const MENSAJES_ERROR = [
        0 => "El pago ya se encuentra dado de baja",
        1 => "El pago ya se encuentra dado de alta",
        2 => "El pago no se encuentra ingresado en el sistema.",
        3 => "El pago ya se encuentra ingresado en el sistema."
    ];

    public function __construct(int $codError)
    {
        parent::__construct(self::MENSAJES_ERROR[$codError], $codError, null);
    }
}