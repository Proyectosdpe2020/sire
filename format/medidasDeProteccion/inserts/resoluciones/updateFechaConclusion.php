<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../../Conexiones/Conexion.php");
include("../../../../Conexiones/conexionMedidas.php");
include("../../../../funcionesMedidasProteccion.php");

$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;
$fechaConclusion = isset($_POST['fechaConclusion']) ? $_POST['fechaConclusion'] : null;

$fConclusion = date("Y-m-d H:i:s", strtotime($fechaConclusion));

$query = "
    BEGIN TRANSACTION;
    BEGIN TRY
        -- Actualiza en la primera tabla
        UPDATE medidas.medidasProteccion
        SET fechaConclusion = ?
        WHERE idMedida = ?;

        -- Actualiza en la segunda tabla
        UPDATE medidas.cuadernoAntecedentes
        SET fechaConclusion = ?
        WHERE idMedida = ?;

        COMMIT;
    END TRY
    BEGIN CATCH
        -- En caso de error, revierte la transacción
        ROLLBACK TRANSACTION;
        -- Lanza el error con un mensaje específico
        DECLARE @ErrorMessage NVARCHAR(4000) = ERROR_MESSAGE();
        DECLARE @ErrorLine INT = ERROR_LINE();
        RAISERROR('Error en la transacción. Mensaje: %s, Línea: %d', 16, 1, @ErrorMessage, @ErrorLine);
    END CATCH;";

$params = [
    [&$fConclusion, SQLSRV_PARAM_IN, null, SQLSRV_SQLTYPE_DATETIME],
    [&$idMedida, SQLSRV_PARAM_IN],
    [&$fConclusion, SQLSRV_PARAM_IN, null, SQLSRV_SQLTYPE_DATETIME],
    [&$idMedida, SQLSRV_PARAM_IN]
];

$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt) {
    $result = sqlsrv_execute($stmt);
    if ($result) {
        echo json_encode(['first' => 'SI', 'idMedidaUltimo' => $idMedida]);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['first' => 'NO', 'errors' => $errors]);
    }
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['first' => 'NO', 'errors' => $errors]);
}
?>
