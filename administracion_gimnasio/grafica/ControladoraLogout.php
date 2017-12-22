<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 11/29/17
 * Time: 9:45 AM
 */

include_once(dirname(__FILE__).'/../logica/objetos/Usuario.php');
session_start();
session_unset();
session_destroy();
header('location: ./../index.php');

?>

