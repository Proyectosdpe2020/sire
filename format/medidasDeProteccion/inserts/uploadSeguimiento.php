<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
    $nuc = isset($_POST['nuc']) ? $_POST['nuc'] : null;
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
    $number = mt_rand(100,1000);

    // Verifica si se han subido archivos
    $uploadedFiles = [];
    foreach ($_FILES as $key => $file) {
        if ($file['error'] == 0) {
            $fileTmpPath = $file['tmp_name'];
            $fileName = $fecha . ' Seguimiento - ' . $nuc . '-' . $number . '.pdf';
            $allowedTypes = ['application/pdf'];

            if (in_array($file['type'], $allowedTypes)) {
                $uploadFileDir = '../documents/seguimientos/';
                $destPath = $uploadFileDir . basename($fileName);

                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                if (move_uploaded_file($fileTmpPath, $destPath)) {                    
                    $query = "INSERT INTO medidas.seguimientos (idMedida, nombre_archivo, ruta_archivo) VALUES (?, ?, ?)";
                    $params = [$idMedida, $fileName, $destPath];
                    $result = sqlsrv_query($connMedidas, $query, $params);
                    $uploadedFiles[] = $fileName; 
                } else {
                    echo json_encode(['message' => 'Ocurrió un error al guardar el archivo.']);
                    exit();
                }
            } else {
                echo json_encode(['message' => 'Por favor, sube un archivo PDF.']);
                exit();
            }
        } else {
            echo json_encode(['message' => 'Error en la subida del archivo: ' . $file['error']]);
            exit();
        }
    }

    // Responde con un mensaje de éxito
    echo json_encode(['message' => 'Archivos guardados exitosamente.', 'files' => $uploadedFiles]);
}
?>
