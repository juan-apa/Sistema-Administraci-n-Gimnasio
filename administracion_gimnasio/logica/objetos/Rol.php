<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/27/17
 * Time: 9:49 AM
 */

class Rol
{
    const ADMINISTRADOR = 0;
    const WEBMASTER = 1;
    const USUARIO = 2;
    const PUBLICO = 3;

    const NOMBRES = [
        'ADMINISTRADOR',
        'WEBMASTER',
        'USUARIO',
        'PUBLICO'
    ];

    /**
     * @param int $idRol
     * @return string
     */
    public static function obtenerRolDeIdRol(int $idRol): string
    {
        $ret = Rol::NOMBRES[Rol::PUBLICO];
        if($idRol < 3 && $idRol>=0)
        {
            $ret = Rol::NOMBRES[$idRol];
        }
        return $ret;
    }
}