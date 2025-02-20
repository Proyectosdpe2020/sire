<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idResolucion = isset($_POST['idResolucion']) ? $_POST['idResolucion'] : null;
$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$ampliada =  isset($_POST['ampliada']) ? $_POST['ampliada'] : null;
$observacion = isset($_POST['observacion']) ? $_POST['observacion'] : null;
$fechaPrevia = isset($_POST['fechaPrevia']) ? $_POST['fechaPrevia'] : null;
$fechaConclusion = isset($_POST['fechaConclusion']) ? $_POST['fechaConclusion'] : null;
$temporalidad = isset($_POST['temporalidad']) ? $_POST['temporalidad'] : null;

$fPrevia = date("Y-m-d H:i:s", strtotime($fechaPrevia));
$fConclusion = date("Y-m-d H:i:s", strtotime($fechaConclusion));

$query = "
BEGIN
 BEGIN TRY 
  BEGIN TRANSACTION
   SET NOCOUNT ON;

     INSERT INTO medidas.ampliada (
        idResolucion, 
        ampliacion, 
        observacion, 
        temporalidadActual, 
        fechaPrevia, 
        fechaConclusion,
        temporalidadPrevia
    )
     VALUES (
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?,
        (
            SELECT temporalidad
            FROM medidas.cuadernoAntecedentes
            WHERE idMedida = ?
        )
    );

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
    &$ampliada,
    &$observacion,
    &$temporalidad,
    array(&$fPrevia, SQLSRV_PARAM_IN, null, SQLSRV_SQLTYPE_DATETIME),
    array(&$fConclusion, SQLSRV_PARAM_IN, null, SQLSRV_SQLTYPE_DATETIME),
    &$idMedida
);

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if($stmt){
    $result = sqlsrv_execute($stmt);
    if($result){
        sqlsrv_commit($connMedidas);
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
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