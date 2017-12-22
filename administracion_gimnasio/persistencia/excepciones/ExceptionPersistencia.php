<?php
    class ExceptionPersistencia extends Exception{
        public const ERROR_CONEXION = 0;
        public const ERROR_QUERY = 1;
        public const ERROR_INSERT = 2;
        public const ERROR_DELETE = 3;
        public const ERROR_UPDATE = 4;
        public const ERROR_SELECT = 5;

        public const MENSAJES_ERROR = [
            0 => "Error al conectarse con la base de datos.",
            1 => "Error al ejecutar la consulta SQL.",
            2 => "Error al insertar los datos a la base de datos.",
            3 => "Error al borrar los datos de la base de datos.",
            4 => "Error al modificar los datos en la base de datos.",
            5 => "Error al obtener los datos de la base de datos.",
        ];

        public function __construct( $codigoError ){
            parent :: __construct(self :: MENSAJES_ERROR[$codigoError], $codigoError, null);
        }
    }
?>