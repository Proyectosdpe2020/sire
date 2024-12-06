<?php 
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idResolucion = isset($_POST['idResolucion']) ? $_POST['idResolucion'] : null;
$ratificacion = isset($_POST['ratificacion']) ? $_POST['ratificacion'] : null;
$observacion = isset($_POST['observacion']) ? $_POST['observacion'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;

$query = "
BEGIN
 BEGIN TRY 
  BEGIN TRANSACTION
   SET NOCOUNT ON

     INSERT INTO medidas.ratificada (idResolucion, ratificada, observacion)
     VALUES (?, ?, ?)

     COMMIT
  END TRY
  BEGIN CATCH
    ROLLBACK TRANSACTION
    RAISERROR('No se realizo la transaccion', 16, 1)
  END CATCH
END";

$params = array(&$idResolucion, &$ratificacion, &$observacion);
$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        sqlsrv_commit($connMedidas);
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
    } else {
        sqlsrv_rollback($connMedidas);
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'error' => $errors]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'error' => $errors]);
}
?>
