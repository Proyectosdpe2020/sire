<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");

$nOficio = isset($_POST['nOficio']) ? $_POST['nOficio'] : null;

$query = "SELECT COUNT(*) AS count FROM medidas.medidasProteccion WHERE nOficio = ?";
$params = array(&$nOficio);

$stmt = sqlsrv_prepare($connMedidas, $query, $params);
if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $count = $row['count'];
        if ( $count > 0 ) {
            echo json_encode(['validate' => true]);
        }
        else {
            echo json_encode(['validate' => false]);
        }
    }
}
else {
    $errors = sqlsrv_errors();
    echo json_encode(['validate' => false, 'error' => $errors]);
}
?>