<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 12/21/17
 * Time: 7:20 PM
 */

include_once(dirname(__FILE__).'/../logica/Fachada.php');
include_once(dirname(__FILE__).'/../persistencia/excepciones/ExceptionPersistencia.php');
include_once(dirname(__FILE__).'/../logica/objetos/Actividad.php');
include_once(dirname(__FILE__).'/../logica/objetos/Rol.php');


try{
    $f = new Fachada();
    $listado = $f -> listadoActividades();

    for($i = 0; $i < sizeof($listado); $i++)
    {
        if($listado[$i] -> getValido() == 1)
        {
            echo "<tr>";
            echo "<td>".$listado[$i] -> getNombre()."</td>";
            echo "<td>".$listado[$i] -> getComienzo()."</td>";
            echo "<td>".$listado[$i] -> getDuracion()."</td>";
            echo "<td>".$listado[$i] -> getProfesor()."</td>";
            $dias = '';
            $diasArr = $listado[$i] -> diasActividad();
            for($j = 0; $j < sizeof($diasArr); $j++)
            {
                $dias = $dias.$diasArr[$j];
                if($j != sizeof($diasArr) - 1)
                    $dias = $dias.'<br/>';
            }
            echo "<td>".$dias."</td>";
            echo "</tr>";
        }
    }
} catch (Exception $e) {
    echo "<script>alert('Error: ".$e -> getMessage()."');</script>";
}