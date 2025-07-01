<?php
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");

include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

$idMp = $_POST['idMp'];
$idUnidad = $_POST['idUnidad'];

$query = "SELECT COUNT(nuc) as total FROM estatusNucs WHERE idMp = ? AND idUnidad = ? AND idEstatus = 181 ";
$params = array($idMp , $idUnidad);

$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la consulta.',
        'rowsAffected' => 0,
        'total' => 0,
        'errors' => sqlsrv_errors()
    ]);
    exit;
}

if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $total = (int)$row['total'];
    echo json_encode([
        'success' => true,
        'message' => 'Trámite actualizado con éxito',
        'rowsAffected' => $total,
        'total' => $total
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No se encontraron resultados.',
        'rowsAffected' => 0,
        'total' => 0
    ]);
}
?>