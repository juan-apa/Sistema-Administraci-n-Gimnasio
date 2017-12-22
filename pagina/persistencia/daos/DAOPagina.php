<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/22/17
 * Time: 8:07 AM
 */

class DAOPagina extends DAO
{

    /**
     * DAOPagina constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Conexion $con
     * @return array
     */
    public function obtenerDatos(Conexion $con) : array
    {
        $conexion = $con -> getConexion();
        $query = Consultas::PAGINA_TODO;
        $rs = $conexion -> query($query);
        $fila = $rs -> fetch_row();
        mysqli_free_result($rs);
        return $fila;
    }

    /**
     * @param Conexion $con
     * @param array $a
     * @throws ExceptionPersistencia
     */
    public function modificarDatos(Conexion $con, array $a) : void
    {
        echo "<script>alert('modificarDatos');</script>";
        $conexion = $con -> getConexion();
        $query = Consultas::PAGINA_BORRAR;
        echo "<script>alert('antesBORRAR');</script>";
        $conexion -> query($query);
        echo "<script>alert('BORRAR');</script>";
        $query = sprintf(Consultas::PAGINA_INSERTAR, $a[0],$a[1],$a[2],$a[3],$a[4],$a[5],$a[6], $a[7],$a[8],$a[9],$a[10],$a[11],$a[12],$a[13],$a[14],$a[15],$a[16], $a[17],$a[18],$a[19], $a[20], $a[21]);
        echo "<script>alert('INSERTAR');</script>";
        $conexion ->query($query);
        echo "<script>alert('despuesInsertar');</script>";
        if($conexion -> affected_rows == 0)
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
    }
}