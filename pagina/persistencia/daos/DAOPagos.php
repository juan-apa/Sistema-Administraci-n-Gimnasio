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
include_once(dirname(__FILE__) . '/../../logica/objetos/TipoPago.php');

class DAOPagos extends DAO
{
    private $idUsuario;

    public function __construct(int $idUsuario)
    {
        parent::__construct();
        $this->idUsuario = $idUsuario;
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
        $query = sprintf(Consultas::PAGOS_LARGO, $this -> idUsuario);
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
        $query = sprintf(Consultas::PAGOS_KESIMO, $this -> idUsuario, $kesimo);

        $rs = $conexion -> query($query);
        if($rs -> num_rows == 0){
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_SELECT);
        }
        $pago = null;
        $pago = $rs -> fetch_assoc();
        if($pago)
        {
            $ret = new Pago($pago['fechaPago'], $pago['tipoPago'], $pago['valido'], $pago['monto'], $pago['idPago'], $pago['idUsuario'], $pago['descripcion'], $pago['duracion']);
        }
        else
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_SELECT);
        }
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
        $query = sprintf(Consultas::PAGOS_LISTADO, $this -> idUsuario);

        $rs = $conexion -> query($query);

        $pago = $rs -> fetch_assoc();
        $aux = null;
        while($pago)
        {
            $aux = new Pago($pago['fechaPago'], $pago['tipoPago'], $pago['valido'], $pago['monto'], $pago['idPago'], $pago['idUsuario'], $pago['descripcion'], $pago['duracion']);
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
        echo "<script>alert('adentro insback')</script>";
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::PAGOS_INSBACK, $pago -> getFechaPago(),
            $pago -> getTipoPago(), $pago -> getMonto(), $pago -> getValido(),
            $this -> largo($con), $this -> idUsuario
        );

        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_INSERT);
        }
    }

    /**
     * @param Conexion $con
     * @return array
     * @throws ExceptionPersistencia
     */
    public static function listadoTiposPagos(Conexion $con) : array
    {
        $ret = array();
        $conexion = $con -> getConexion();
        $query = Consultas::TIPOS_PAGOS;
        $rs = $conexion -> query($query);
        if($rs -> num_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_SELECT);
        }
        else
        {
            $fila = $rs -> fetch_assoc();
            while($fila)
            {
                array_push($ret, new TipoPago($fila['tipoPago'], $fila['descripcion'], $fila['duracion']));
                $fila = $rs -> fetch_assoc();
            }
        }
        mysqli_free_result($rs);
        return $ret;
    }

    /**
     * @param Conexion $con
     * @param int $idPago
     * @throws ExceptionPersistencia
     */
    public function delete(Conexion $con, int $idPago) : void
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::PAGOS_BAJA, $this -> idUsuario, $idPago);
        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
        }
    }


    /**
     * @param Conexion $con
     * @param int $idPago
     * @throws ExceptionPersistencia
     */
    public function alta(Conexion $con, int $idPago) : void
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::PAGOS_ALTA, $this -> idUsuario, $idPago);
        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
        }
    }

    /**
     * @param Conexion $con
     * @param int $idPago
     * @param string $fecNuevo
     * @param int $tipoNuevo
     * @param int $montoNuevo
     * @throws ExceptionPersistencia
     */
    public function modificarPago(Conexion $con, int $idPago, string $fecNuevo, int $tipoNuevo, int $montoNuevo) : void
    {
        $conexion = $con -> getConexion();
        $query = sprintf(Consultas::PAGOS_MODIFICAR, $fecNuevo, $tipoNuevo, $montoNuevo, $this -> idUsuario, $idPago);
        $conexion -> query($query);
        if($conexion -> affected_rows == 0)
        {
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
        }
    }
}