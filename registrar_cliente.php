<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y procesar los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Insertar datos en la base de datos
    $stmt = $mysqli->prepare("INSERT INTO clientes (nombre, email, telefono, direccion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $nombre, $email, $telefono, $direccion);
    
    if ($stmt->execute()) {
        echo 'Cliente registrado correctamente.';
    } else {
        echo 'Error al registrar al cliente: ' . $stmt->error;
    }

    $stmt->close();
}

// Aquí puedes incluir el formulario HTML para registrar clientes
?>
