<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/20/17
 * Time: 8:37 PM
 */

include_once(dirname(__FILE__).'/../Consultas.php');
include_once(dirname(__FILE__).'/../../logica/objetos/Usuario.php');

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



    public function member($cedula)
    {
        $ret = 0;
        /*Preparo la query a la DB.*/
        $query = sprintf(Consultas::USUARIOS_EXISTE_CEDULA, $cedula);
        $rs = $this -> conexion -> query($query);
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

    public function insert(Usuario $usuario)
    {
        $query = sprintf(
                            Consultas::USUARIOS_INGRESAR, $usuario->getNombre(), $usuario -> getApellido(),
                            $usuario -> getCedula(), $usuario -> getDireccion(), $usuario -> getFechaNacimiento(),
                            $usuario -> getSocMedica(), $usuario -> getEmerMovil(), $usuario -> getAntecedentes(),
                            $usuario -> getObservaciones(), $usuario -> getValido(), $usuario -> getIdRol()
                        );

        $this -> conexion -> query($query);
        if($this -> conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_INSERT);
        }
    }

    public function delete($cedula)
    {
        $query = sprintf(Consultas::USUARIOS_ELIMINAR, $cedula);
        $this -> conexion -> query($query);
        if($this -> conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_DELETE);
        }
    }

    public function obtenerUsuario($cedula)
    {
        $ret = null;
        $query = sprintf(Consultas::USUARIOS_OBTENER, $cedula);
        $rs = $this -> conexion -> query($query);
        if(!$rs)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_QUERY);
        }
        else
        {
            $usuario = null;
            while($user = $rs -> fetch_assoc())
            {
                $idUsuario = $user['idUsuario'];
                $ret = new Usuario( $idUsuario, $user['nombre'], $user['apellido'], $user['cedula'], $user['direccion'],
                                    $user['fechaNacimiento'], $user['socMedica'], $user['emerMovil'], $user['antecedentes'],
                                    $user['observaciones'], $user['valido'], $user['idRol'], new DAOTelefonos($idUsuario),
                                    new DAORutinas($idUsuario), new DAOPagos($idUsuario)
                );
            }
        }
        return $ret;
    }

    public function listarUsuarios()
    {
        $ret = array();
        $query = Consultas::USUARIOS_LISTAR;
        $rs = $this -> conexion -> query($query);
        if(!$rs)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_QUERY);
        }
        else
        {
            $usuario = null;
            while($user = $rs -> fetch_assoc())
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
        return $ret;
    }

    public function modify($cedula, Usuario $user)
    {
        $idUsuario = $user['idUsuario'];
        $query = sprintf(Consultas::USUARIOS_MODIFICAR, $idUsuario, $user -> getNombre(), $user -> getApellido(),
            $user -> getCedula(), $user -> getDireccion(), $user -> getFechaNacimiento(), $user -> getSocMedica(),
            $user -> getEmerMovil(), $user -> getAntecedentes(), $user -> getObservaciones(), $user -> getValido(),
            $user -> getIdRol(), $cedula
        );
        $this -> conexion -> query($query);
        if($this -> conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
        }
    }
}