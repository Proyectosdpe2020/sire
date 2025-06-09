<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$value = isset($_POST['value']) ? $_POST['value'] : null;
$field = isset($_POST['field']) ? $_POST['field'] : null;

$validFields = ['cuadernoAntecedentes', 'temporalidad'];

if (!in_array($field, $validFields)) {
    echo json_encode(['first' => 'NO', 'errors' => 'Campo inválido']);
    exit;
}

$query = "
    UPDATE medidas.cuadernoAntecedentes
    SET $field = ?
    WHERE idMedida = ?";

$params = [
    [&$value, SQLSRV_PARAM_IN],
    [&$idMedida, SQLSRV_PARAM_IN]
];
    
$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        sqlsrv_commit($connMedidas);
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'errors' => $errors]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'errors' => $errors]);
}

?>