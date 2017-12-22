<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/6/17
 * Time: 9:28 AM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');
include_once(dirname(__FILE__).'/../logica/objetos/Rol.php');
include_once(dirname(__FILE__) . '/../logica/objetos/Pago.php');
include_once(dirname(__FILE__) . '/../logica/objetos/TipoPago.php');

class ControladoraRegistroPago
{
    private $cedula;
    private $fachada;
    private $listado;

    /**
     * ControladoraRegistroPago constructor.
     *
     */
    public function __construct()
    {
        try{
            $this -> fachada = new Fachada();
        } catch (Exception $e){
            echo "<script>alert('Error: ".$e -> getMessage()."');</script>";
        }
    }

    public function listadoTiposPagos() : void
    {
        $this -> listado = $this -> fachada -> listadoTipoPagos();
        for($i = 0; $i < sizeof($this -> listado); $i++)
        {
            echo "<option value='".$this -> listado[$i] -> getTipoPago()."'>".$this -> listado[$i] -> getDescripcion()."</option>";
        }
    }


    public function registroPago(string $fechaPago, int $tipoPago, int $monto, int $cedulaUsuario) : void
    {
        $tiposPagos = $this -> fachada -> listadoTipoPagos();
        $i = 0;
        $salir = 0;
        $duracion = 0;
        $descripcion = "";
        while(!$salir && $i < sizeof($tiposPagos))
        {
            if($tiposPagos[$i] -> getTipoPago() == $tipoPago)
            {
                $duracion = $tiposPagos[$i] -> getDuracion();
                $descripcion = $tiposPagos[$i] -> getDescripcion();
                $salir = 1;
            }
            else
            {
                $i++;
            }
        }
        echo "<script>alert('Cedula usuario: ".$cedulaUsuario."')</script>";
        $this -> fachada -> registroPagoUsuario($cedulaUsuario, new Pago($fechaPago, $tipoPago, 1, $monto, 0, 0, $descripcion, $duracion));
        echo "<script>alert('registro con éxito.')</script>";
    }
}