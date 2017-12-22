<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/21/17
 * Time: 2:32 PM
 */

include_once(dirname(__FILE__).'/../../persistencia/Conexion.php');
include_once(dirname(__FILE__).'/../../persistencia/Consultas.php');
include_once(dirname(__FILE__).'/../../logica/objetos/Telefono.php');

class DAOTelefonos extends DAO
{
    private $idUsuario;

    /**
     * DAOTelefonos constructor.
     * @param integer $idUsuario
     */
    public function __construct(int $idUsuario)
    {
        parent::__construct();
        $this -> idUsuario = $idUsuario;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @param Conexion $con
     * @param int $telefono
     * @throws ExceptionPersistencia
     */
    public function insback(Conexion $con, int $telefono)
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::TELEFONOS_INSERTAR, $this -> idUsuario, $telefono);
        $conexion -> query($query);

        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_INSERT);
        }
    }

    /**
     * @param Conexion $con
     * @param int $telefono
     * @throws ExceptionPersistencia
     */
    public function delete(Conexion $con, int $telefono)
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::TELEFONOS_BORRAR, $this -> idUsuario, $telefono);
        $conexion -> query($query);

        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_DELETE);
        }
    }

    /**
     * @param Conexion $con
     * @return array
     */
    public function listarTelefonos(Conexion $con) : array
    {
        $ret = array();
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::TELEFONOS_LISTAR, $this -> idUsuario);
        $rs = $conexion -> query($query);
        $fila = $rs -> fetch_assoc();

        while($fila)
        {
            array_push($ret, $fila['telefono']);
            $filra = $rs -> fetch_assoc();
        }

        mysqli_free_result($rs);
        return $ret;
    }

}