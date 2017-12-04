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
include_once(dirname(__FILE__).'/../excepciones/ExceptionPersistencia.php');

class DAOUsuarios extends DAO
{
    /**
     * DAOUsuarios constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Devuelve 1 si el usuario con la cedula $cedula se encuentra ingresado en el sistema. Devuelve 0 de lo contrario.
     * @param Conexion $con
     * @param int $cedula
     * @return int devuelve 1 si existe el usuario, 0 de lo contrario
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     */
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
            /*Si la cantidad de filas de los resultados no es 0, entonces es porque no hay un usuario con la cedula deseada.*/
            if($rs -> num_rows > 0)
            {
                $ret = 1;
            }
        }

        /*Libero los resultados de memoria*/
        mysqli_free_result($rs);

        /*Devuelvo 1 o 0, dependiendo si habia 1 resultado de la consulta a la DB.*/
        return $ret;
    }

    /**
     * Inserta el usuario $usuario en el sistema. \nPrecondición: No puede haber un usuario con la cédula que tiene $usuario ya ingresado en el sistema.
     * @param Conexion $con
     * @param Usuario $usuario
     * @throws ExceptionPersistencia en caso de que haya un error al insertar los datos de la DB.
     */
    public function insert(Conexion $con, Usuario $usuario)
    {
        $conexion = $con -> getConexion();
        $query = sprintf(
                            Consultas::USUARIOS_INGRESAR, $usuario->getNombre(), $usuario -> getApellido(),
                            $usuario -> getCedula(), $usuario -> getDireccion(), $usuario -> getFechaNacimiento(),
                            $usuario -> getSocMedica(), $usuario -> getEmerMovil(), $usuario -> getAntecedentes(),
                            $usuario -> getObservaciones(), $usuario -> getValido(), $usuario -> getIdRol(),
                            $usuario -> getContrasenia()
                        );

        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_INSERT);
        }
    }

    /**
     * Cambia el bit de validez del usuario con la misma $cedula ingresado en el sistema a 0.\nPrecondición: Debe haber un usuario con la misma $cedula ingresado en el sistema.
     * @param Conexion $con
     * @param int $cedula
     * @throws ExceptionPersistencia en caso de que haya un error al borrar los datos de la DB.
     */
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

    /**
     * @param Conexion $con
     * @param int $cedula
     * @throws ExceptionPersistencia en caso de que haya un error al modificar los datos en la DB.
     */
    public function alta(Conexion $con, int $cedula)
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::USUARIOS_ALTA, $cedula);
        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
        }
    }

    /**
     * Obtiene el usuario de la base de datos con la misma $cedula.
     * @param Conexion $con
     * @param int $cedula
     * @return null|Usuario
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     */
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
            if($user)
            {
                $idUsuario = $user['idUsuario'];
                $ret = new Usuario( $idUsuario, $user['nombre'], $user['apellido'], $user['cedula'], $user['direccion'],
                                    $user['fechaNacimiento'], $user['socMedica'], $user['emerMovil'], $user['antecedentes'],
                                    $user['observaciones'], $user['valido'], $user['idRol'], $user['contrasenia']
                );
            }
        }
        mysqli_free_result($rs);
        return $ret;
    }

    /**
     * Devuelve un arreglo con todos los usuarios ingresados en el sistema.
     * @param Conexion $con
     * @return array
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     */
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
                    $user['observaciones'], $user['valido'], $user['idRol'], $user['contrasenia']
                );
                array_push($ret, $usuario);
                $user = $rs -> fetch_assoc();
            }
        }
        mysqli_free_result($rs);
        return $ret;
    }

    /**
     * Sustituye todos los datos del con la $cedula en la base de datos con los datos en $user
     * @param Conexion $con
     * @param int $cedula
     * @param Usuario $user
     * @throws ExceptionPersistencia en caso de que haya un error al modificar los datos de la DB.
     */
    public function modify(Conexion $con, int $cedula, Usuario $user)
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::USUARIOS_MODIFICAR, $user -> getNombre(), $user -> getApellido(),
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

    /**
     * Devuelve 1 si existe un usuario con la $cedulaUsuario y y la $passwordUsuario. Devuelve 0 de lo contrario.
     * @param Conexion $con
     * @param int $cedulaUsuario
     * @param string $passwordUsuario
     * @return int devuelve 1 si el usuario es válido, 0 de lo contrario.
     */
    public function validarUsuario(Conexion $con, int $cedulaUsuario, string $passwordUsuario): int
    {
        $ret = 0;
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::USUARIOS_VALIDAR, $cedulaUsuario, $passwordUsuario);
        $rs = $conexion -> query($query);
        if($rs -> num_rows > 0)
        {
            $ret = 1;
        }
        mysqli_free_result($rs);
        return $ret;
    }

    /**
     * Devuelve el rol del usuario con la misma $cedulaUsuario de la base de datos.
     * @param Conexion $con
     * @param int $cedulaUsuario
     * @return string Devuelve un string con el rol del usuario, puede ser 'ADMINISTRADOR', 'WEBMASTER', 'USUARIO'
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     */
    public function obtenerRolUsuario(Conexion $con, int $cedulaUsuario): string
    {
        $ret = '';
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::ROL_USUARIO, $cedulaUsuario);
        $rs = $conexion -> query($query);
        if($rs -> num_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_SELECT);
        }
        else
        {
            $fila = $rs -> fetch_assoc();
            $ret = $fila['rol'];
        }
        mysqli_free_result($rs);
        return $ret;
    }

    /**
     * @param Conexion $con
     * @param int $cedulaUsuario
     * @return int devuelve un int con el campo valido del usuario (puede ser 0 o 1).
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     */
    public function estadoDeUsuario(Conexion $con, int $cedulaUsuario): int
    {
        $ret = 0;
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::USUARIOS_ESTADO, $cedulaUsuario);
        $rs = $conexion -> query($query);
        if($rs -> num_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_SELECT);
        }
        else
        {
            $fila = $rs -> fetch_assoc();
            $ret = $fila['valido'];
        }
        mysqli_free_result($rs);
        return $ret;
    }
}