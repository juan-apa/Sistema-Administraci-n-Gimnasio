<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/21/17
 * Time: 3:39 PM
 */

include_once(dirname(__FILE__).'/../persistencia/Conexion.php');
include_once(dirname(__FILE__).'/../persistencia/daos/DAOUsuarios.php');
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
        echo "<h1>Fachada construida</h1>";
    }

    /**
     * @param Usuario $usuario
     * @return void
     * @throws ExceptionUsuario en caso de que ya exista el usuario.
     * @throws ExceptionPersistencia en caso de que haya un error al obtener datos de la DB.
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
     * @throws ExceptionPersistencia en caso de que haya un error al obtener datos de la DB.
     */
    public function bajaUsuario(int $cedulaUsuario): void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
            $this -> usuarios -> delete($this -> conexion, $cedulaUsuario);
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
     * @throws ExceptionPersistencia en caso de que haya un error al obtener datos de la DB.
     */
    public function modificarUsuario(int $cedulaUsuario, Usuario $usuario): void
    {
        if($this -> usuarios -> member($this -> conexion, $cedulaUsuario))
        {
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
}