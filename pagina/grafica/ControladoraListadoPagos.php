<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/4/17
 * Time: 9:53 PM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');
include_once(dirname(__FILE__).'/../logica/objetos/Rol.php');
include_once(dirname(__FILE__) . '/../logica/objetos/Pago.php');

$cedula = $_GET['cedula'];

class ControladoraListadoPagos{
    private $cedula;
    private $fachada;
    private $listado;

    public function __construct()
    {
        $this -> listado = array();
        try{
            $this -> f = new Fachada();
        } catch (Exception $e){
            echo "<script>alert('Error: ".$e -> getMessage()."');</script>";
        }
    }

    public function listarPagos(int $cedulaUsuario) : void
    {
        try{
            $this -> listado = $this -> f -> listadoPagos($cedulaUsuario);
            for($i = 0; $i < sizeof($this->listado); $i++)
            {
                if($this->listado[$i] -> getValido())
                {
                    echo "<tr class='table-info'>";
                }
                else
                {
                    echo "<tr class='table-warning'>";
                }
                echo "<td>".$this->listado[$i] -> getFechaPago()."</td>";
                echo "<td>".$this->listado[$i] -> getDescripcion()."</td>";
                echo "<td>".$this->listado[$i] -> getMonto()."</td>";
                echo "<td>".$this->listado[$i] -> getDuracion()."</td>";
                if($this->listado[$i] -> getValido())
                {
                    echo "<td> <a href='../bajaUsuario.php?cedPasada=".$this->listado[$i] -> getIdUsuario()."'>Activo</a> </td>";
                }
                else
                {
                    echo "<td> <a href='../altaUsuario.php?cedPasada=".$this->listado[$i] -> getIdUsuario()."'>Inactivo</a> </td>";
                }
                echo "<td style='text-align: center'> <a href='../modificacionPago.php?cedPasada=".$cedulaUsuario."&idPago=".$this -> listado[$i] -> getIdPago()."' class='btn btn-warning' role='button'><i class='fa fa-fw fa-pencil'></i></a> </td>";
                echo "</tr>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Error: ".$e -> getMessage()."');</script>";
        }

    }
}