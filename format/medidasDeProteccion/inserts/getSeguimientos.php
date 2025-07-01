<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");

$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;

$query = "
    SELECT idSeguimiento, nombre_archivo, ruta_archivo
    FROM medidas.seguimientos
    WHERE idMedida = ?
";

$params = array(&$idMedida);
$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt && sqlsrv_execute($stmt)) {
    $seguimientos = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $seguimientos[] = array(
            'idSeguimiento' => $row['idSeguimiento'],
            'nombre_archivo' => $row['nombre_archivo'],
            'ruta_archivo' => $row['ruta_archivo']
        );
    }
    echo json_encode($seguimientos);
} else {
    $errors = sqlsrv_errors();
    echo json_encode($errors);
}

?>