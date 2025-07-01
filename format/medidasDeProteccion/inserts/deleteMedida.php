<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");

$idMedida = isset($_POST['idMedida']) ? $_POST['idMedida'] : null;

$query = "
    BEGIN TRY
	BEGIN TRANSACTION;

	SET NOCOUNT ON;
        DECLARE @idResolucion INT;
        DECLARE @idMedida INT = ?;
        
        SELECT @idResolucion = idResolucion FROM sire.medidas.resoluciones WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.ratificada WHERE idResolucion = @idResolucion;
        DELETE FROM sire.medidas.ampliada  WHERE idResolucion = @idResolucion;
        DELETE FROM sire.medidas.modificada WHERE idResolucion = @idResolucion;
        DELETE FROM sire.medidas.revocada WHERE idResolucion = @idResolucion;
        DELETE FROM sire.medidas.imputados WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.victimas WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.cuadernoAntecedentes WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.medidasAplicadas WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.constanciaLlamadas WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.testigo WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.medidasAplicadasTestigo WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.resoluciones WHERE idMedida = @idMedida;
        DELETE FROM sire.medidas.medidasProteccion WHERE idMedida = @idMedida;

        COMMIT;
    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        THROW;
    END CATCH;	
";

$params = array(&$idMedida);
$stmt = sqlsrv_prepare($connMedidas, $query, $params);

if ($stmt && sqlsrv_execute($stmt)) {
    echo json_encode(['success' => true]);
} else {
    $errors = sqlsrv_errors();
    echo json_encode(['success' => false, 'error' => $errors]);
}

?>