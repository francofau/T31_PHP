<?php 
/* Crear conexión con sus credenciales */
function crear_conexion(){
    $host = $_ENV[''];/* colocar credenciales */
    $user = $_ENV[''];/* colocar credenciales */
    $password = $_ENV[''];/* colocar credenciales */
    $mysql = new mysqli($host, $user, $password, 'Articulos');

    if($mysql->connect_error)     
        return false;
    else
        return $mysql;
}

?>
