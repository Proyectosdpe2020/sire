<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idItem = isset($_POST['idItem']) ? $_POST['idItem'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$table = isset($_POST['table']) ? $_POST['table'] : null;

if ($idItem && $table) {
    $idTable = 'id' . ucfirst($table);
    $query = "DELETE FROM medidas.$table WHERE $idTable = ?";
    $params = [&$idItem];

    $stmt = sqlsrv_prepare($connMedidas, $query, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        sqlsrv_commit($connMedidas);
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'errors' => $errors]);
    }
} else {
    echo json_encode(['first' => 'NO', 'errors' => 'Faltan parámetros']);
}
?>
