<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/21/17
 * Time: 3:39 PM
 */

include_once(dirname(__FILE__).'/../persistencia/Conexion.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOUsuarios.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOPagos.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOActividades.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOPagina.php');
include_once(dirname(__FILE__).'/objetos/Usuario.php');
include_once(dirname(__FILE__).'/objetos/Rutina.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPago.php');

class Fachada
{
    private $conexion;
    private $usuarios;
    private $instancia = null;
    private $actividades;
    private $pagina;

    /**
     * Fachada constructor.
     * @throws ExceptionPersistencia si hay un error al establecer una conexion con la base de datos.
     */
    public function __construct()
    {
        $this -> conexion = new Conexion();
        $this -> usuarios = new DAOUsuarios();
        $this -> actividades = new DAOActividades();
        $this -> pagina = new DAOPagina();
    }

    /**
     * @return Fachada
     */
    public function getInstancia()
    {
        if($this -> instancia == null){
            $this -> instancia = new Fachada();
        }
        return $this -> instancia;
    }

    /**
     *
     */
    public function __destruct()
    {
        $this -> conexion = null;
        $this -> usuarios = null;
        $this -> instancia = null;
    }

    public function test(){
        echo "<h1>Test Fachada</h1>";
    }

    /**
     * @param Usuario $usuario
     * @return void
     * @throws ExceptionUsuario en caso de que ya exista el usuario.
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     * @throws ExceptionPersistencia en caso de que haya un error al insertar los datos en la DB.
     */
    public function registroUsuario(Usuario $usuario): void
    {
        if(! $this -> usuarios -> member($this -> conexion, $usuario -> getCedula()))
        {
            $this -> usuarios -> insert($this -> conexion, $usuario);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::EXISTE_USUARIO);
        }
    }

    /**
     * @param int $cedulaUsuario
     * @return void
     * @throws ExceptionUsuario en caso de que no exista el usuario.
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     * @throws ExceptionPersistencia en caso de que haya un error al modificar los datos de la DB.
     */
    public function bajaUsuario(int $cedulaUsuario): void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            if($this -> usuarios -> estadoDeUsuario($this -> conexion, $cedulaUsuario))
            {
                $this -> usuarios -> delete($this -> conexion, $cedulaUsuario);
            }
            else
            {
                throw new ExceptionUsuario(ExceptionUsuario::USUARIO_DE_BAJA);
            }
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

    /**
     * @param int $cedulaUsuario
     * @throws ExceptionUsuario en caso de que el usuario ya se encuentre dado de alta.ExceptionUsuario
     * @throws ExceptionPersistencia en caso de que haya un error al obtener/modificar los datos de la DB.
     */
    public function altaUsuario(int $cedulaUsuario): void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            if(! $this -> usuarios -> estadoDeUsuario($this -> conexion, $cedulaUsuario))
            {
                $this -> usuarios -> alta($this -> conexion, $cedulaUsuario);
            }
            else
            {
                throw new ExceptionUsuario(ExceptionUsuario::USUARIO_DE_ALTA);
            }
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

    /**
     * @param int $cedulaUsuario
     * @param Usuario $usuario
     * @return void
     * @throws ExceptionUsuario en caso de que el nuevo usuario ya tenga la cedula ingresada.
     * @throws ExceptionUsuario en caso de que no exista el usuario que se desea modificar.
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     * @throws ExceptionPersistencia en caso de que haya un error al modificar los datos de la DB.
     */
    public function modificarUsuario(int $cedulaUsuario, Usuario $usuario): void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            // Si las cedulas no son iguales me tengo que fijar que la nueva no esté ingresada.
            if($cedulaUsuario != $usuario -> getCedula())
            {
                if(! $this -> usuarios -> member($this -> conexion, $usuario -> getCedula()))
                {
                    $this -> usuarios -> modify($this -> conexion, $cedulaUsuario, $usuario);
                }
                else
                {
                    throw new ExceptionUsuario(ExceptionUsuario::EXISTE_NUEVO_USUARIO);
                }
            }
            else
            {
                // Si las cédulas son iguales, modifico asi nomas
                $this -> usuarios -> modify($this -> conexion, $cedulaUsuario, $usuario);
            }
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

    /**
     * @param int $cedulaUsuario
     * @param Rutina $rutina
     * @return void
     * @throws ExceptionUsuario en caso de que no exista el usuario.
     * @throws ExceptionPersistencia en caso de que haya un error al obtener datos de la DB.
     */
    public function insertarRutina(int $cedulaUsuario, Rutina $rutina): void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario) -> insertarRutina($this -> conexion, $rutina);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

    /**
     * @param int $cedulaUsuario
     * @return Usuario
     * @throws ExceptionUsuario en caso de que no exista el usuario.
     * @throws ExceptionPersistencia en caso de que haya un error al obtener datos de la DB.
     */
    public function obtenerUsuario(int $cedulaUsuario): Usuario
    {
        $ret = null;
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            $ret = $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
        return $ret;
    }

    /**
     * @param int $cedulaUsuario
     * @param string $password
     * @throws ExceptionUsuario en caso de que no exista el usuario o la pareja cedula-contraseña sean inválidos
     * @throws ExceptionPersistencia en caso de que haya un error al obtener datos de la DB
     */
    public function loginUsuario(int $cedulaUsuario, string $password): void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            if($this -> usuarios -> validarUsuario($this -> conexion, $cedulaUsuario, $password))
            {
                /*Como el la cedula y contrasenia coinciden, inicio una sesion con los datos del usuario*/
                $usuario = $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario);
                session_start();
//                if(session_status() == PHP_SESSION_ACTIVE){
//                    echo "<script>alert('fac: sesion iniciada')</script>";
//                }
//                if(session_status() == PHP_SESSION_NONE){
//                    echo "<script>alert('fac: sesion NONE')</script>";
//                }
//                if(session_status() == PHP_SESSION_DISABLED){
//                    echo "<script>alert('fac: sesion DISABLED')</script>";
//                }
                $_SESSION['usuario'] = $usuario;
            }
            else
            {
                throw new ExceptionUsuario(ExceptionUsuario::CEDULA_CONTRASENIA_INVALIDA);
            }
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }


    /**
     * @param int $cedulaUsuario
     * @return string
     * @throws ExceptionUsuario en caso de que no exista el usuario.
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     */
    public function obtenerRolUsuario(int $cedulaUsuario):string
    {
        $rol = '';
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            $rol = $this -> usuarios -> obtenerRolUsuario($this -> conexion, $cedulaUsuario);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
        return $rol;
    }

    /**
     * @return array
     * @throws ExceptionPersistencia en caso de que haya un error al obtener los datos de la DB.
     */
    public function listadoUsuarios():array
    {
        return $this -> usuarios -> listarUsuarios($this -> conexion);
    }

    /**
     * @param int $cedulaUsuario
     * @return array
     * @throws ExceptionPersistencia
     * @throws ExceptionUsuario
     */
    public function listadoPagos(int $cedulaUsuario) : array
    {
        $ret = array();
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            $ret = $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario) -> getPagos() -> listado($this -> conexion);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
        return $ret;
    }

    /**
     * @return array
     * @throws ExceptionPersistencia
     */
    public function listadoTipoPagos() : array
    {
        $ret = DAOPagos::listadoTiposPagos($this -> conexion);
        return $ret;
    }

    /**
     * @param int $cedulaUsuario
     * @param Pago $pago
     * @throws ExceptionPersistencia
     * @throws ExceptionUsuario
     */
    public function registroPagoUsuario(int $cedulaUsuario, Pago $pago) : void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            $usuario = $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario);
            $usuario -> insertarPago($this->conexion, $pago);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

    /**
     * @param int $cedulaUsuario
     * @param int $kesimo
     * @return Pago
     * @throws ExceptionPersistencia
     * @throws ExceptionUsuario
     */
    public function kesimoPagoDeUsuario(int $cedulaUsuario, int $kesimo) : Pago{
        $ret = null;
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            $ret = $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario) -> kesimoPago($this -> conexion, $kesimo);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
        return $ret;
    }

    /**
     * @param int $cedulaUsuario
     * @param int $idPago
     * @throws ExceptionPago
     * @throws ExceptionPersistencia
     * @throws ExceptionUsuario
     */
    public function bajaPago(int $cedulaUsuario, int $idPago) : void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            if($idPago < $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario) -> largoPagos($this -> conexion))
            {
                $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario) -> bajaPago($this -> conexion, $idPago);
            }
            else
            {
                throw new ExceptionPago(ExceptionPago::NO_EXISTE_PAGO);
            }
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

    /**
     * @param int $cedulaUsuario
     * @param int $idPago
     * @throws ExceptionPago
     * @throws ExceptionPersistencia
     * @throws ExceptionUsuario
     */
    public function altaPago(int $cedulaUsuario, int $idPago) : void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            if($idPago < $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario) -> largoPagos($this -> conexion))
            {
                $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario) -> altaPago($this -> conexion, $idPago);
            }
            else
            {
                throw new ExceptionPago(ExceptionPago::NO_EXISTE_PAGO);
            }
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }


    /**
     * @param int $cedulaUsuario
     * @param int $idPago
     * @param string $fecNuevo
     * @param int $tipoNuevo
     * @param int $montoNuevo
     * @throws ExceptionPersistencia
     * @throws ExceptionUsuario
     */
    public function modificacionPago(int $cedulaUsuario, int $idPago, string $fecNuevo, int $tipoNuevo, int $montoNuevo) : void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            $usuario = $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario);
            $usuario -> modificacionPago($this -> conexion, $idPago, $fecNuevo, $tipoNuevo, $montoNuevo);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

    /**
     * @return array
     */
    public function listadoActividades() : array
    {
        return $this -> actividades -> listadoActividades($this -> conexion);
    }

    /**
     * @param Actividad $a
     * @throws ExceptionPersistencia
     */
    public function registroActividad(Actividad $a) : void
    {
        $this -> actividades -> registroActividad($this -> conexion, $a);
    }

    /**
     * @param int $cedulaUsuario
     * @return int
     * @throws ExceptionPersistencia
     * @throws ExceptionUsuario
     */
    public function pagoAtrasado(int $cedulaUsuario) : int
    {
        $ret = 1;
        $arr = $this -> listadoPagos($cedulaUsuario);
        $i = 0;
        $salir = 0;
        while($salir == 0 && $i < sizeof($arr))
        {
            if($arr[$i] -> getValido())
            {
                $ret = $arr[$i] -> atrasado();
                $salir = 1;
            }
            $i++;
        }
        return $ret;
    }

    /**
     * @return array
     * @throws ExceptionPersistencia
     */
    public function cantidades() : array
    {
        $ret = array(0=>0,1=>0,2=>0);
        $listado = $this -> listadoUsuarios();
        for($i = 0; $i < sizeof($listado); $i++)
        {
            $ret[$listado[$i] -> getIdRol()] = $ret[$listado[$i] -> getIdRol()] + 1;
        }
        return $ret;
    }

    /**
     * @param $mes
     * @return int
     */
    public function facturacionMes($mes) : int
    {
        return $this -> usuarios -> facturacionMes($this -> conexion, $mes);
    }

    /**
     * @param $anio
     * @return int
     */
    public function facturacionAnio($anio) : int
    {
        return $this -> usuarios -> facturacionAnio($this -> conexion, $anio);
    }

    /**
     * @return array
     */
    public function obtenerDatosPagina() : array
    {
        return $this -> pagina -> obtenerDatos($this -> conexion);
    }

    /**
     * @param array $arr
     * @throws ExceptionPersistencia
     */
    public function modificarPagina(array $arr) : void
    {
        echo "<script>alert('modificarPagina');</script>";
        $this -> pagina -> modificarDatos($this -> conexion, $arr );
    }
}