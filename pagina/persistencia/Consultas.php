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
                                                      emerMovil, antecedentes, observaciones, valido, idRol, contrasenia) 
                                            VALUES('%s', '%s', %d, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s')";

    const USUARIOS_ELIMINAR = "UPDATE Usuarios SET valido=0 WHERE cedula = %d";

    const USUARIOS_ALTA = "UPDATE Usuarios SET valido=1 WHERE cedula = %d";

    const USUARIOS_OBTENER = "SELECT * FROM Usuarios WHERE cedula = %d";

    const USUARIOS_LISTAR = "SELECT * FROM Usuarios";

    const USUARIOS_MODIFICAR = "UPDATE Usuarios SET 
                                    nombre='%s', apellido='%s', cedula=%d, direccion='%s', fechaNacimiento='%s', 
                                    socMedica='%s', emerMovil='%s', antecedentes='%s', observaciones='%s', valido=%d, idRol='%d'
                                    WHERE cedula = %d";

    const USUARIOS_VALIDAR = "SELECT * FROM Usuarios WHERE cedula = %d AND contrasenia = '%d'";

    const USUARIOS_ESTADO = "SELECT valido FROM Usuarios WHERE cedula = %d";

    const TELEFONOS_LISTAR = "SELECT T.* FROM Telefonos T, Usuarios U WHERE T.idUsuario=U.idUsuario AND U.idUsuario = %d";

    const TELEFONOS_INSERTAR = "INSERT INTO Telefonos (idUsuario, telefono) VALUES(%d, %d)";

    const TELEFONOS_BORRAR = "DELETE FROM Telefonos WHERE idUsuario=%d AND telefono=%d";

    const ROL_USUARIO = "SELECT R.rol FROM Usuarios U, Roles R WHERE U.idRol = R.idRol AND U.cedula=%d";

    const PAGOS_LARGO = "SELECT P.idPago FROM Pagos P WHERE P.idUsuario=%d";

    const PAGOS_KESIMO = "SELECT P.*, T.descripcion, T.duracion FROM Pagos P, TipoPago T WHERE P.idUsuario = %d AND P.idPago=%d AND P.tipoPago = T.tipoPago";

    const PAGOS_LISTADO = "SELECT P.*, T.descripcion, T.duracion FROM Pagos P, TipoPago T WHERE P.idUsuario = %d AND P.tipoPago = T.tipoPago ORDER BY P.fechaPago DESC";

    const PAGOS_INSBACK = "INSERT INTO Pagos (fechaPago, tipoPago, monto, valido, idPago, idUsuario) VALUES ('%s', %d, %d, %d, %d, %d)";

    const TIPOS_PAGOS = "SELECT * FROM TipoPago T";

    const PAGOS_BAJA = "UPDATE Pagos SET valido=0 WHERE idUsuario=%d AND idPago=%d";

    const PAGOS_ALTA = "UPDATE Pagos SET valido=1 WHERE idUsuario=%d AND idPago=%d";

    const PAGOS_MODIFICAR = "UPDATE Pagos SET fechaPago='%s', tipoPago=%d, monto=%d WHERE idUsuario=%d AND idPago=%d";

    const PAGOS_VENCIDO = "SELECT * FROM Gimnasio.Pagos P where NOW() > P.fechaPago + %d";

    const PAGOS_FACTURACION_ANIO = "SELECT SUM(monto) FROM Gimnasio.Pagos where YEAR(fechaPago) = %d";

    const PAGOS_FACTURACION_MES = "SELECT SUM(monto) FROM Gimnasio.Pagos where MONTH(fechaPago) = %d";

    const ACTIVIDADES_LISTADO = "SELECT * FROM Actividades";

    const ACTIVIDADES_REGISTRO = "INSERT INTO Actividades (comienzo, duracion, nombre, profesor, valido, lunes, martes, miercoles, jueves, viernes) VALUES ('%s', %d, '%s', '%s', %d, %d, %d, %d, %d, %d)";

    const PAGINA_TODO = "SELECT * FROM Pagina";

    const PAGINA_BORRAR = "DELETE FROM Pagina";

    const PAGINA_INSERTAR = "INSERT INTO Pagina VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
}