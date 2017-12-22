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
     * @param string $titulo
     * @param string $c1ti
     * @param string $c1te
     * @param string $c2ti
     * @param string $c2te
     * @param string $c3ti
     * @param string $c3te
     * @param string $titulo2
     * @param string $c4ti
     * @param string $c4te
     * @param string $c5ti
     * @param string $c5te
     * @param string $c6ti
     * @param string $c6te
     * @param string $fti
     * @param string $fte
     * @param string $c1i
     * @param string $c2i
     * @param string $c3i
     * @param string $c4i
     * @param string $c5i
     * @param string $c6i
     * @throws ExceptionPersistencia
     */
    public function modificarDatos(Conexion $con, string $titulo, string $c1ti, string $c1te, string $c2ti, string $c2te,
                                   string $c3ti, string $c3te, string $titulo2, string $c4ti, string $c4te, string $c5ti,
                                   string $c5te, string $c6ti, string $c6te, string $fti, string $fte, string $c1i,
                                   string $c2i, string $c3i, string $c4i, string $c5i, string $c6i) : void
    {
        echo "<script>alert('modificarDatos');</script>";
        $conexion = $con -> getConexion();
        $query = Consultas::PAGINA_BORRAR;
        echo "<script>alert('antesBORRAR');</script>";
        $conexion -> query($query);
        echo "<script>alert('BORRAR');</script>";
        $query = sprintf(Consultas::PAGINA_INSERTAR, $titulo, $c1ti, $c1te,$c2ti, $c2te, $c3ti, $c3te, $titulo2,
            $c4ti, $c4te, $c5ti, $c5te, $c6ti, $c6te, $fti, $fte, $c1i, $c2i, $c3i, $c4i, $c5i, $c6i);
        echo "<script>alert('INSERTAR');</script>";
        $conexion ->query($query);
        echo "<script>alert('despuesInsertar');</script>";
        if($conexion -> affected_rows == 0)
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_UPDATE);
    }
}