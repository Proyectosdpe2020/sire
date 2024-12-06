<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$fraccion = isset($_POST['fraccion']) ? $_POST['fraccion'] : null;

$query = "
    DELETE FROM medidas.medidasAplicadas
    WHERE idMedida = ? AND idCatFraccion = ?";

$params = [
    [&$idMedida, SQLSRV_PARAM_IN],
    [&$fraccion, SQLSRV_PARAM_IN]
];

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if($stmt){
    $result = sqlsrv_execute($stmt);
    if($result){
        sqlsrv_commit($connMedidas);
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
    }
    else{
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'errors' => $errors]);
    }
}
else{
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'errors' => $errors]);
}

?>