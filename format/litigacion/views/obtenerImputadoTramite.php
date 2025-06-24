<?php
header('Content-Type: application/json');
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");

include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

$idImputadoTramite = $_POST['idImputadoTramite'];

$query = "SELECT * FROM tramiteImputadoLitigacion WHERE idImputadoTramite = ?";
$params = array($idImputadoTramite);
$stmt = sqlsrv_query($conn, $query, $params);

if($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta']);
    exit;
}

if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo json_encode([
        'success' => true,
        'data' => [
            'nombre' => $row['nombre'],
            'paterno' => $row['apellidoPaterno'],
            'materno' => $row['apellidoMaterno']
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Imputado no encontrado']);
}
?>