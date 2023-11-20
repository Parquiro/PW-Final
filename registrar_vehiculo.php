<?php
// registrar_vehiculo.php

// Incluye el archivo de configuración
include('config.php');

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge los datos del formulario
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tipo = $_POST['tipo'];
    $ano = $_POST['ano'];
    $clasificacion = $_POST['clasificacion'];
    $repuesto_asignado = $_POST['repuesto_asignado'];

    // Procesa la imagen
    $imagen = $_FILES['imagen'];
    $imagen_nombre = $imagen['name'];
    $imagen_temporal = $imagen['tmp_name'];
    $imagen_ruta = 'imagenes/' . uniqid() . '.jpg'; // Nombre único para evitar colisiones

    move_uploaded_file($imagen_temporal, $imagen_ruta);

    // Inserta los datos en la base de datos
    $stmt = $mysqli->prepare("INSERT INTO vehiculos (descripcion, marca, modelo, tipo, ano, clasificacion, repuesto_asignado, qr_code, imagen_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $qr_code = uniqid(); // Puedes usar una lógica más sofisticada para generar códigos QR únicos
    $stmt->bind_param('ssssissss', $descripcion, $marca, $modelo, $tipo, $ano, $clasificacion, $repuesto_asignado, $qr_code, $imagen_ruta);
    $stmt->execute();
    $stmt->close();

    // Redirige o muestra un mensaje de éxito, según sea necesario
    header('Location: index.php'); // Cambia esto según tu estructura de carpetas y nombres de archivos
    exit();
}
?>
