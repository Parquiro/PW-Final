<?php
require_once('config.php'); // Asegúrate de incluir tu archivo de configuración

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y procesar los datos del formulario
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Insertar datos en la base de datos (similar a registrar_vehiculo.php)
    $stmt = $mysqli->prepare("INSERT INTO repuestos (descripcion, marca, modelo, precio, cantidad) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssdi', $descripcion, $marca, $modelo, $precio, $cantidad);
    
    if ($stmt->execute()) {
        echo 'Repuesto registrado correctamente.';
    } else {
        echo 'Error al registrar el repuesto: ' . $stmt->error;
    }

    $stmt->close();
}

// Aquí puedes incluir el formulario HTML para registrar repuestos
?>

