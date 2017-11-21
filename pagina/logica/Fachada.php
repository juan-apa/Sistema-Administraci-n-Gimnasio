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

class Fachada
{
    private $conexion;
    private $usuarios;
    private $instancia = null;

    private function __construct()
    {
        $this -> conexion = new Conexion();
        $this -> usuarios = new DAOUsuarios();
    }

    public function getInstancia()
    {
        if($this -> instancia == null){
            $this -> instancia = new Fachada();
        }
        return $this -> instancia;
    }

    public function __destruct()
    {
        $this -> conexion = null;
        $this -> usuarios = null;
        $this -> instancia = null;
    }

    /**
     * @param Usuario $usuario
     * @throws ExceptionUsuario
     */
    public function registroUsuario(Usuario $usuario)
    {
        if(! $this -> usuarios -> member($usuario -> getCedula()))
        {
            $this -> usuarios -> insert($usuario);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::EXISTE_USUARIO);
        }
    }

    public function bajaUsuario(int $cedulaUsuario)
    {
        if($this -> usuarios -> member($cedulaUsuario))
        {
            $this -> usuarios -> delete($cedulaUsuario);
        }
        else
        {
            throw new ExceptionUsuario(ExceptionUsuario::NO_EXISTE_USUARIO);
        }
    }

    public function modificarUsuario(int $cedulaUsuario, Usuario $usuario)
    {
        if($this -> usuarios -> member($cedulaUsuario))
        {
            if($cedulaUsuario != $usuario -> getCedula())
            {
                if(! $this -> usuarios -> member($usuario -> getCedula()))
                {
                    $this -> usuarios -> modify($cedulaUsuario, $usuario);
                }
                else
                {
                    // TODO terminar todos los else para tirar las excepciones adecuadas.
                    throw new ExceptionUsuario();
                }
            }
        }
    }
}