<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 8:37 PM
 */

include_once(dirname(__FILE__).'/../Consultas.php');
include_once(dirname(__FILE__).'/../../logica/objetos/Usuario.php');
include_once(dirname(__FILE__).'/../Conexion.php');

class DAOUsuarios extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }



    public function member(Conexion $con, int $cedula)
    {
        $conexion = $con -> getConexion();
        $ret = 0;
        /*Preparo la query a la DB.*/
        $query = sprintf(Consultas::USUARIOS_EXISTE_CEDULA, $cedula);
        $rs = $conexion -> query($query);
        /*Si la consulta a la DB no devolvió un objeto de resultados tiro una excepcion de persistencia.*/
        if(!$rs)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_QUERY);
        }
        else
        {
            /*Si la cantidad de filas de los resultados no es 1, entonces es porque no hay un usuario con la cedula deseada.*/
            if($rs -> num_rows == 0)
            {
                $ret = 1;
            }
        }

        /*Libero los resultados de memoria*/
        mysqli_free_result($rs);

        /*Devuelvo 1 o 0, dependiendo si habia 1 resultado de la consulta a la DB.*/
        return $ret;
    }

    public function insert(Conexion $con, Usuario $usuario)
    {
        $conexion = $con -> getConexion();
        $query = sprintf(
                            Consultas::USUARIOS_INGRESAR, $usuario->getNombre(), $usuario -> getApellido(),
                            $usuario -> getCedula(), $usuario -> getDireccion(), $usuario -> getFechaNacimiento(),
                            $usuario -> getSocMedica(), $usuario -> getEmerMovil(), $usuario -> getAntecedentes(),
                            $usuario -> getObservaciones(), $usuario -> getValido(), $usuario -> getIdRol()
                        );

        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_INSERT);
        }
    }

    public function delete(Conexion $con, int $cedula)
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::USUARIOS_ELIMINAR, $cedula);
        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_DELETE);
        }
    }

    public function obtenerUsuario(Conexion $con, int $cedula)
    {
        $conexion = $con -> getConexion();
        $ret = null;
        $query = sprintf(Consultas::USUARIOS_OBTENER, $cedula);
        $rs = $conexion -> query($query);
        if(!$rs)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_QUERY);
        }
        else
        {
            $usuario = null;
            $user = $rs -> fetch_assoc();
            while($user)
            {
                $idUsuario = $user['idUsuario'];
                $ret = new Usuario( $idUsuario, $user['nombre'], $user['apellido'], $user['cedula'], $user['direccion'],
                                    $user['fechaNacimiento'], $user['socMedica'], $user['emerMovil'], $user['antecedentes'],
                                    $user['observaciones'], $user['valido'], $user['idRol'], new DAOTelefonos($idUsuario),
                                    new DAORutinas($idUsuario), new DAOPagos($idUsuario)
                );
            }
        }
        mysqli_free_result($rs);
        return $ret;
    }

    public function listarUsuarios(Conexion $con)
    {
        $conexion = $con -> getConexion();
        $ret = array();
        $query = Consultas::USUARIOS_LISTAR;
        $rs = $conexion -> query($query);
        if(!$rs)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_QUERY);
        }
        else
        {
            $usuario = null;
            $user = $rs -> fetch_assoc();
            while($user)
            {
                $idUsuario = $user['idUsuario'];
                $usuario= new Usuario( $idUsuario, $user['nombre'], $user['apellido'], $user['cedula'], $user['direccion'],
                    $user['fechaNacimiento'], $user['socMedica'], $user['emerMovil'], $user['antecedentes'],
                    $user['observaciones'], $user['valido'], $user['idRol'], new DAOTelefonos($idUsuario),
                    new DAORutinas($idUsuario), new DAOPagos($idUsuario)
                );
                array_push($ret, $usuario);
            }
        }
        mysqli_free_result($rs);
        return $ret;
    }

    public function modify(Conexion $con, int $cedula, Usuario $user)
    {
        $conexion = $con -> getConexion();
        $idUsuario = $user['idUsuario'];
        $query = sprintf(Consultas::USUARIOS_MODIFICAR, $idUsuario, $user -> getNombre(), $user -> getApellido(),
            $user -> getCedula(), $user -> getDireccion(), $user -> getFechaNacimiento(), $user -> getSocMedica(),
            $user -> getEmerMovil(), $user -> getAntecedentes(), $user -> getObservaciones(), $user -> getValido(),
            $user -> getIdRol(), $cedula
        );
        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
        }
    }
}