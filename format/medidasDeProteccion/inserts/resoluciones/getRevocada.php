<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idResolucion = isset($_POST['idResolucion']) ? $_POST['idResolucion'] : null;

$query = "  SELECT revocada, observacion, fechaRevocada
            FROM medidas.revocada
            WHERE idResolucion = ?";
$params = array(&$idResolucion);

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if($stmt){
    $result = sqlsrv_execute($stmt);
    if($result){
        $array = [];
        while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
            $array[] = $row;
        }
        echo json_encode(['first' => 'SI', 'array' => $array]);
    }
    else{
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'error' => $errors]);
    }
}
else{
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'error' => $errors]);
}

?>