<?php
header('Content-Type: application/json; charset=utf-8');
$file = isset($_GET['path']) ? $_GET['path'] : null;

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf'); // Ajusta el tipo de contenido según el archivo
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    
    readfile($file);
    exit;
} else {
    http_response_code(404); // Código de respuesta 404 Not Found
    echo json_encode(['respuesta' => false, 'mensaje' => 'Archivo no encontrado']);
}
?>
