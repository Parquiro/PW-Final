<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y procesar los datos del formulario
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Insertar datos en la base de datos
    $stmt = $mysqli->prepare("INSERT INTO mecanicos (nombre, especialidad, email, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $nombre, $especialidad, $email, $telefono, $direccion);
    
    if ($stmt->execute()) {
        echo 'Mecánico registrado correctamente.';
    } else {
        echo 'Error al registrar al mecánico: ' . $stmt->error;
    }

    $stmt->close();
}

// Aquí puedes incluir el formulario HTML para registrar mecánicos
?>
