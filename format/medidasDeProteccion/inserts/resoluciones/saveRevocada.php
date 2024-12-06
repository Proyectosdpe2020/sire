<?php 
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idResolucion = isset($_POST['idResolucion']) ? $_POST['idResolucion'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$revocada = isset($_POST['revocada']) ? $_POST['revocada'] : null;
$observacion = isset($_POST['observacion']) ? $_POST['observacion'] : null;
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;

// Convertimos la fecha al formato compatible con SQL Server
$fechaAcuerdo = date("Y-m-d H:i:s", strtotime($fecha));
//echo "Fecha convertida: " . $fechaAcuerdo;


$query = "
BEGIN
 BEGIN TRY 
  BEGIN TRANSACTION
   SET NOCOUNT ON;

     INSERT INTO medidas.revocada (idResolucion, revocada, observacion, fechaRevocada)
     VALUES (?, ?, ?, ?);

     COMMIT;
  END TRY
  BEGIN CATCH
    ROLLBACK TRANSACTION;
    DECLARE @ErrorMessage NVARCHAR(4000) = ERROR_MESSAGE();
    DECLARE @ErrorLine INT = ERROR_LINE();
    RAISERROR('Error en la transacción. Mensaje: %s, Línea: %d', 16, 1, @ErrorMessage, @ErrorLine);
  END CATCH
END";


$params = array(
    &$idResolucion, 
    &$revocada, 
    &$observacion, 
    array(&$fechaAcuerdo, SQLSRV_PARAM_IN, null, SQLSRV_SQLTYPE_DATETIME)
);

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        sqlsrv_commit($connMedidas);
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'error' => $errors, 'fecha' => $fechaAcuerdo]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'error' => $errors, 'fecha' => $fechaAcuerdo]);
}
?>
