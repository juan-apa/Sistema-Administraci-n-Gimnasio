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
include_once(dirname(__FILE__).'/objetos/Usuario.php');
include_once(dirname(__FILE__).'/objetos/Rutina.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionUsuario.php');

class Fachada
{
    private $conexion;
    private $usuarios;
    private $instancia = null;

    /**
     * Fachada constructor.
     * @throws ExceptionPersistencia si hay un error al establecer una conexion con la base de datos.
     */
    public function __construct()
    {
        $this -> conexion = new Conexion();
        $this -> usuarios = new DAOUsuarios();
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

    public function listadoTipoPagos() : array
    {
        $ret = DAOPagos::listadoTiposPagos($this -> conexion);
        return $ret;
    }

    public function registroPagoUsuario(int $cedulaUsuario, Pago $pago)
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            echo "<script>alert('adentro member')</script>";
            $usuario = $this -> usuarios -> obtenerUsuario($this -> conexion, $cedulaUsuario);
            echo "<script>alert('Antes insertar')</script>";
            $usuario -> insertarPago($this->conexion, $pago);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

}