<?php
// config.php

$host = 'localhost';
$usuario = 'root';
$clave = '';
$nombre_base_datos = 'icarplus';

$mysqli = new mysqli($host, $usuario, $clave, $nombre_base_datos);

if ($mysqli->connect_error) {
    die('Error de conexión a la base de datos: ' . $mysqli->connect_error);
}
?>
