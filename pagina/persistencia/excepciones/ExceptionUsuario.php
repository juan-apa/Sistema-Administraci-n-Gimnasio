<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/21/17
 * Time: 3:46 PM
 */

class ExceptionUsuario extends Exception
{
    public const EXISTE_USUARIO = 0;
    public const NO_EXISTE_USUARIO = 1;
    public const EXISTE_NUEVO_USUARIO = 2;
    public const CEDULA_CONTRASENIA_INVALIDA = 3;

    private const MENSAJES_ERROR = [
        0 => "El usuario ya se encuentra ingresado en el sistema.",
        1 => "El usuario no se encuentra ingresado en el sistema.",
        2 => "El nuevo usuario ya se encuentra ingresado en el sistema.",
        3 => "La cedula y/o contrasenia son invalidas"
    ];

    public function __construct(int $codError)
    {
        parent::__construct(self::MENSAJES_ERROR[$codError], $codError, null);
    }
}