<?php
require_once('TCPDF-main/tcpdf.php');


// Configuración de la página PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Informe de la Base de Datos');
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);

// Agrega una página al PDF
$pdf->AddPage();

// Conexión a la base de datos (ajusta los detalles según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "icarplus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta y genera PDF para la tabla de Vehículos
generatePDF($pdf, $conn, 'vehiculos');

// Consulta y genera PDF para la tabla de Repuestos
generatePDF($pdf, $conn, 'repuestos');

// Consulta y genera PDF para la tabla de Clientes
generatePDF($pdf, $conn, 'clientes');

// Consulta y genera PDF para la tabla de Mecánicos
generatePDF($pdf, $conn, 'mecanicos');

// Cierra la conexión a la base de datos
$conn->close();

// Genera el PDF
$pdf->Output('Informe_Base_Datos.pdf', 'I');

// Función para generar PDF para una tabla específica
function generatePDF($pdf, $conn, $table) {
    $pdf->Cell(0, 10, strtoupper($table), 1, 0, 'C');
    $pdf->Ln(); // Nueva línea para el siguiente registro

    // Consulta los datos de la base de datos (ajusta la consulta según tu estructura)
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    // Procesa los resultados y agrega al PDF
    if ($result->num_rows > 0) {
        // Agrega los encabezados de las columnas
        $columns = [];
        while ($column_info = $result->fetch_field()) {
            $columns[] = $column_info->name;
        }
        foreach ($columns as $column) {
            $pdf->Cell(40, 10, strtoupper($column), 1);
        }
        $pdf->Ln(); // Nueva línea para los datos

        // Agrega los datos al PDF
        while ($row = $result->fetch_assoc()) {
            foreach ($columns as $column) {
                $pdf->Cell(40, 10, $row[$column], 1);
            }
            $pdf->Ln(); // Nueva línea para el siguiente registro
        }
    } else {
        $pdf->Cell(0, 10, 'No se encontraron registros', 1, 0, 'C');
    }

    $pdf->Ln(); // Nueva línea entre tablas
}
?>
