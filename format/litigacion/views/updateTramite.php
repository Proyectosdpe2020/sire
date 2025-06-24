<?php
header('Content-Type: application/json');
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");

include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

$idCarpetaTramite = $_POST['idCarpetaTramite'];
$causaPenalImpu_tramite = $_POST['causaPenalImpu_tramite'];
$cuadernoImpu_tramite = $_POST['cuadernoImpu_tramite'];
$requerimientoImpu_tramite = $_POST['requerimientoImpu_tramite'];
$sedeJudicialImpu_tramite = $_POST['sedeJudicialImpu_tramite'];


$query = "UPDATE tramiteLitigacion 
          SET causaPenal = ?, cuadernoAntecedentes = ?, cuadernoConRequerimiento = ? , archivoEnSedeJudicial = ?
          WHERE idCarpetaTramite = ?";

$params = array($causaPenalImpu_tramite , $cuadernoImpu_tramite , $requerimientoImpu_tramite , $sedeJudicialImpu_tramite , $idCarpetaTramite);
$stmt = sqlsrv_query($conn, $query, $params);

if($stmt === false) {
    $errors = sqlsrv_errors();
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar',
        'error' => ($errors ? $errors[0]['message'] : 'Error desconocido')
    ]);
    exit;
}


// Verificar si se actualizó algún registro
$rowsAffected = sqlsrv_rows_affected($stmt);

if($rowsAffected > 0) {
    echo json_encode([
        'success' => true,
        'message' => 'Trámite actualizado con éxito',
        'rowsAffected' => $rowsAffected
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No se encontró el registro para actualizar'
    ]);
}

// Liberar recursos
sqlsrv_free_stmt($stmt);


?>