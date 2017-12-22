<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/21/17
 * Time: 7:05 PM
 */

include_once(dirname(__FILE__).'/DAO.php');
include_once(dirname(__FILE__).'/../Consultas.php');
include_once(dirname(__FILE__).'/../Conexion.php');
include_once(dirname(__FILE__).'/../excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../../logica/objetos/Actividad.php');

class DAOActividades extends DAO
{
    /**
     * DAOActividades constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Conexion $con
     * @return array
     */
    public function listadoActividades(Conexion $con) : array
    {
        $ret = array();
        $conexion = $con -> getConexion();
        $query = Consultas::ACTIVIDADES_LISTADO;
        $rs = $conexion -> query($query);
        $fila = $rs -> fetch_assoc();
        while($fila)
        {
            array_push($ret, new Actividad($fila['idActividad'], $fila['comienzo'], $fila['duracion'], $fila['nombre'], $fila['profesor'], (int) $fila['valido'], $fila['lunes'], $fila['martes'], $fila['miercoles'], $fila['jueves'], $fila['viernes']));
            $fila = $rs -> fetch_assoc();
        }
        mysqli_free_result($rs);
        return $ret;
    }
}