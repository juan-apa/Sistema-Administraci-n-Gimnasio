<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 8:43 PM
 */

class Consultas
{
    const USUARIOS_EXISTE_CEDULA = "SELECT * FROM Usuarios WHERE cedula = %d";

    const USUARIOS_INGRESAR = "INSERT INTO Usuarios ( nombre, apellido, cedula, direccion, fechaNacimiento, socMedica,
                                                      emerMovil, antecedentes, observaciones, valido, idRol) 
                                            VALUES('%s', '%s', %d, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d)";

    const USUARIOS_ELIMINAR = "DELETE FROM Usuarios WHERE cedula = %d";

    const USUARIOS_OBTENER = "SELECT * FROM Usuarios WHERE cedula = %d";

    const USUARIOS_LISTAR = "SELECT * FROM Usuarios";

    const USUARIOS_MODIFICAR = "UPDATE Usuarios SET 
                                    idUsuario=%d, nombre='%s', apellido='%s', cedula=%d, direccion='%s', fechaNacimiento='%s', 
                                    socMedica='%s', emerMovil='%s', antecedentes='%s', observaciones='%s', valido=%d, idRol='%d'
                                    WHERE cedula = %d";

    const TELEFONOS_LISTAR = "SELECT * FROM Telefonos";
}