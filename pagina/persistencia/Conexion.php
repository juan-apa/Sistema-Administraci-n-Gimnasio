<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/21/17
 * Time: 3:33 PM
 */

include_once(dirname(__FILE__).'/excepciones/ExceptionPersistencia.php');

class Conexion
{
    private $url;
    private $user;
    private $password;
    private $db;
    private $conexion;

    /**
     * Conexion constructor.
     * @return Conexion
     * @throws ExceptionPersistencia si hay un error al establecer una conexion con la base de datos.
     */
    public function __construct()
    {
        $this -> url = '127.0.0.1';
        $this -> user = 'root';
        $this -> password = '290980196';
        $this -> db = 'Gimnasio';
        $this -> conexion = new mysqli($this -> url, $this -> user, $this -> password, $this -> db);
        if($this -> conexion -> connect_errno){
            throw new ExceptionPersistencia(ExceptionPersistencia::ERROR_CONEXION);
        }
    }

    public function __destruct()
    {
        if($this -> conexion != null){
            $this -> conexion -> close();
        }
    }

    public function obtenerConexion()
    {
        return $this -> conexion;
    }

}