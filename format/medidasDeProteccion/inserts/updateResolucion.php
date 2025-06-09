<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

// VARIABLES DEL FORMULARIO OBTENIDO
$resolucion = isset($_POST['resolucion']) ? $_POST['resolucion'] : null;
$observacionResolucion = isset($_POST['observacionResolucion']) ? $_POST['observacionResolucion'] : null;
$idResolucion = isset($_POST['idResolucion']) ? $_POST['idResolucion'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$resolucionValue = isset($_POST['resolucionValue']) ? $_POST['resolucionValue'] : null;

$observacionRes = 'observacion' . ucfirst($resolucionValue);

// Iniciar la transacción
sqlsrv_begin_transaction($connMedidas);

$queryTransaction = "
    UPDATE medidas.resoluciones 
    SET $resolucionValue = ?, $observacionRes = ? 
    WHERE idResolucion = ?";

// Preparar la consulta
$params = array($resolucion, $observacionResolucion, $idResolucion);
$result = sqlsrv_query($connMedidas, $queryTransaction, $params);

if ($result) {
    sqlsrv_commit($connMedidas);
    echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
} else {
    sqlsrv_rollback($connMedidas);
    // Obtener el error para diagnóstico
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'error' => $errors]);
}
?>
