<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/22/17
 * Time: 9:20 AM
 */

include_once(dirname(__FILE__) . '/DAO.php');
include_once(dirname(__FILE__) . '/../Consultas.php');
include_once(dirname(__FILE__) . '/../../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__) . '/../Conexion.php');
include_once(dirname(__FILE__) . '/../../logica/objetos/Pago.php');

class DAOPagos extends DAO
{
    private $cedulaUsuario;

    public function __construct(int $cedulaUsuario)
    {
        parent::__construct();
        $this->cedulaUsuario = $cedulaUsuario;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @param Conexion $con
     * @return int Devuelve 1 si el usuario tiene pagos ingresados. 0 de lo contrario.
     */
    public function empty(Conexion $con): int
    {
        $ret = 0;
        if($this -> largo($con) == 0)
        {
            $ret = 1;
        }
        return $ret;
    }

    /**
     * @param Conexion $con
     * @return int Devuelve un int con la cantidad de pagos realizados por el usuario.
     */
    public function largo(Conexion $con) : int
    {
        $ret = 0;
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::PAGOS_LARGO, $this -> cedulaUsuario);
        $rs = $conexion -> query($query);
        $ret = $rs -> num_rows;
        mysqli_free_result($rs);
        return $ret;
    }

    /**
     * @param Conexion $con
     * @param int $kesimo
     * @return Pago devuelve el pago con el id=$kesimo correspondiente al usuario.
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     */
    public function k_esimo(Conexion $con, int $kesimo) : Pago
    {
        $ret = null;
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::PAGOS_KESIMO, $this -> cedulaUsuario);

        $rs = $conexion -> query($query);
        if($rs -> num_rows == 0){
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_SELECT);
        }
        $i = 0;
        $salir = 0;
        $pago = null;
        $pago = $rs -> fetch_assoc();
        while($pago && !$salir)
        {
            if($i == $kesimo)
            {
                $salir = 1;
            }
            else
            {
                $pago = $rs -> fetch_assoc();
                $i++;
            }
        }
        $ret = new Pago($pago['fechaPago'], $pago['tipoPago'], $pago['duracion'], $pago['valido'], $pago['idPago'], $this -> cedulaUsuario);
        mysqli_free_result($rs);
        return $ret;
    }

    /**
     * @param Conexion $con
     * @return array devuelve un array con todos los pagos del usuario.
     */
    public function listado(Conexion $con) : array
    {
        $conexion = $con -> getConexion();
        $ret = array();
        $query = sprintf(Consultas::PAGOS_LISTADO, $this -> cedulaUsuario);

        $rs = $conexion -> query($query);

        $pago = $rs -> fetch_assoc();
        $aux = null;
        while($pago)
        {
            $aux = new Pago($pago['fechaPago'], $pago['tipoPago'], $pago['duracion'], $pago['valido'], $pago['idPago'], $this -> cedulaUsuario);
            array_push($ret, $aux);
            $pago = $rs -> fetch_assoc();
        }
        mysqli_free_result($rs);
        return $ret;
    }

    /**
     * @param Conexion $con
     * @param Pago $pago
     * @throws ExceptionPersistencia en caso de que haya un error al insertar los datos en la DB.
     */
    public function insBack(Conexion $con, Pago $pago) : void
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::PAGOS_INSBACK, $pago -> getFechaPago(),
            $pago -> getTipoPago(), $pago -> getDuracion(), $pago -> getValido(),
            $this -> largo($con), $this -> cedulaUsuario
        );

        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_INSERT);
        }
    }

    /**
     * @param Conexion $con
     * @param int $idPago
     * @throws ExceptionPersistencia en caso de que haya un error al modificar los datos de la DB.
     */
    public function remove(Conexion $con, int $idPago)
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::PAGOS_DELETE, $this -> cedulaUsuario, $idPago);
        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
        }
    }
}